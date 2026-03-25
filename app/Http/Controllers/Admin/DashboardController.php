<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\FormSubmission;
use App\Models\JobApplication;
use App\Models\NewsPost;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $pendingForms = FormSubmission::where('status', 'pending')->count();
        $pendingJobs = JobApplication::where('status', 'pending')->count();
        $latestNews = NewsPost::latest('created_at')->take(5)->get();

        return view('admin.dashboard.index', compact(
            'unreadMessages',
            'pendingForms',
            'pendingJobs',
            'latestNews'
        ));
    }
}
