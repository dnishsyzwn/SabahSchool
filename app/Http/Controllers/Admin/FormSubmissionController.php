<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{
    public function index()
    {
        $allSubmissions = FormSubmission::with('formType')->latest()->get();
        $submissions = $allSubmissions->groupBy(function($item) {
            if ($item->status === 'approved' || $item->status === 'rejected') {
                return 'selesai_group';
            }
            return $item->status;
        });
        
        return view('admin.form-submissions.index', compact('submissions'));
    }

    public function show(FormSubmission $formSubmission)
    {
        $formSubmission->load('formType');
        return view('admin.form-submissions.show', compact('formSubmission'));
    }

    public function updateStatus(Request $request, FormSubmission $formSubmission)
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

        $currentOrder = $statusOrder[$formSubmission->status] ?? 0;
        $newOrder = $statusOrder[$validated['status']] ?? 0;

        // If already at final status (approved/rejected), prevent any changes
        if ($currentOrder === 3) {
            $msg = 'Borang ini telah selesai diproses and statusnya tidak boleh diubah lagi.';
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return back()->with('error', $msg);
        }

        // Prevent moving backwards
        if ($newOrder < $currentOrder) {
            $msg = 'Status borang tidak boleh dikembalikan ke tahap sebelumnya.';
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return back()->with('error', $msg);
        }

        $formSubmission->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $formSubmission->admin_notes,
            'status_changed_by' => auth()->id(),
            'status_changed_at' => now(),
        ]);

        // Send email notification for final statuses
        if ($validated['status'] === 'approved' || $validated['status'] === 'rejected') {
            try {
                \Illuminate\Support\Facades\Mail::to($formSubmission->email)->send(new \App\Mail\FormSubmissionStatusUpdate($formSubmission));
            } catch (\Throwable $e) {
                // Log error but continue
                \Log::error("Failed to send status update email for submission {$formSubmission->id}: " . $e->getMessage());
            }
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Status borang telah dikemaskini.']);
        }

        return back()->with('success', 'Status borang telah dikemaskini.');
    }

    public function destroy(FormSubmission $formSubmission)
    {
        $formSubmission->delete();
        return redirect()->route('admin.form-submissions.index')->with('success', 'Penghantaran borang telah dipadam.');
    }
}
