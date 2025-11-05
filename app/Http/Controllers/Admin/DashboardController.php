<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Blog;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        // Counts pulled dynamically
        $totalBlogs = Blog::count();
        $totalUsers = User::count();
        $newComments = Comment::where('created_at', '>=', now()->subDays(7))->count();

        return view('admin.dashboard', compact('totalBlogs', 'totalUsers', 'newComments'));
    }
}
