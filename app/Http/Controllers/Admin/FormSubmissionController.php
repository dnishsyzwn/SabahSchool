<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{
    public function index()
    {
        $submissions = FormSubmission::with('formType')->latest()->paginate(10);
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

        $formSubmission->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'],
            'status_changed_by' => auth()->id(),
            'status_changed_at' => now(),
        ]);

        return back()->with('success', 'Status borang telah dikemaskini.');
    }

    public function destroy(FormSubmission $formSubmission)
    {
        $formSubmission->delete();
        return redirect()->route('admin.form-submissions.index')->with('success', 'Penghantaran borang telah dipadam.');
    }
}
