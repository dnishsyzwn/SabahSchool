<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index()
    {
        $allApplications = JobApplication::with('job')->latest()->get();
        $applications = $allApplications->groupBy(function($item) {
            if ($item->status === 'approved' || $item->status === 'rejected') {
                return 'selesai_group';
            }
            return $item->status;
        });

        return view('admin.job-applications.index', compact('applications'));
    }

    public function show(JobApplication $jobApplication)
    {
        $jobApplication->load('job');
        return view('admin.job-applications.show', compact('jobApplication'));
    }

    public function updateStatus(Request $request, JobApplication $jobApplication)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $statusOrder = [
            'pending' => 1,
            'reviewed' => 2,
            'approved' => 3,
            'rejected' => 3
        ];

        $currentOrder = $statusOrder[$jobApplication->status] ?? 0;
        $newOrder = $statusOrder[$validated['status']] ?? 0;

        // If already at final status (approved/rejected), prevent any changes
        if ($currentOrder === 3) {
            $msg = 'Permohonan ini telah selesai diproses and statusnya tidak boleh diubah lagi.';
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return back()->with('error', $msg);
        }

        // Prevent moving backwards
        if ($newOrder < $currentOrder) {
            $msg = 'Status permohonan tidak boleh dikembalikan ke tahap sebelumnya.';
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return back()->with('error', $msg);
        }

        $jobApplication->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $jobApplication->admin_notes,
            'status_changed_by' => auth()->id(),
            'status_changed_at' => now(),
        ]);

        // Send email notification for final statuses
        if ($validated['status'] === 'approved' || $validated['status'] === 'rejected') {
            try {
                \Illuminate\Support\Facades\Mail::to($jobApplication->email)->send(new \App\Mail\JobApplicationStatusUpdate($jobApplication));
            } catch (\Throwable $e) {
                // Log error but continue
                \Log::error("Failed to send status update email for job application {$jobApplication->id}: " . $e->getMessage());
            }
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Status permohonan telah dikemaskini.']);
        }

        return back()->with('success', 'Status permohonan telah dikemaskini.');
    }

    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();
        return redirect()->route('admin.kerjaya.index')->with('success', 'Permohonan telah dipadam.');
    }
}
