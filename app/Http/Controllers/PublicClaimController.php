<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Http\Request;

class PublicClaimController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sort = $request->query('sort', 'latest');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Claim::with('images')
            ->where('status', 'published');

        // Search logic
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('member_name', 'like', "%{$search}%")
                  ->orWhere('school', 'like', "%{$search}%")
                  ->orWhere('disease_type', 'like', "%{$search}%")
                  ->orWhere('claim_type', 'like', "%{$search}%");
            });
        }

        // Date range logic
        if ($startDate) {
            $query->whereDate('published_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('published_at', '<=', $endDate);
        }

        // Sort logic
        $query = match($sort) {
            'oldest'      => $query->oldest('published_at'),
            'name_asc'    => $query->orderBy('member_name', 'asc'),
            'name_desc'   => $query->orderBy('member_name', 'desc'),
            'date_asc'    => $query->orderBy('published_at', 'asc'),
            'date_desc'   => $query->orderBy('published_at', 'desc'),
            default       => $query->latest('published_at'),
        };

        $claims = $query->paginate(10);

        return view('pages.bukti-tuntutan', compact('claims'));
    }
}
