<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // Show all blogs by this user
    public function index()
    {
        $blogs = Blog::where('user_id', Auth::id())->latest()->paginate(6);
        return view('user.blogs.index', compact('blogs'));
    }

    // Show create form
    public function create()
    {
        return view('user.blogs.create');
    }

    // Store new blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Blog::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'content' => $request->content,
        ]);

        return redirect()->route('user.blogs.index')->with('success', 'Blog created successfully!');
    }

    // Show edit form
    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);
        return view('user.blogs.edit', compact('blog'));
    }

    // Update blog
    public function update(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('user.blogs.index')->with('success', 'Blog updated successfully!');
    }

    // Delete blog
    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);
        $blog->delete();

        return redirect()->route('user.blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
