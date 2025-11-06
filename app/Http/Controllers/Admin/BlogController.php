<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
   {
    $blogs = \App\Models\Blog::with('user')->latest()->paginate(10);
    return view('admin.blogs.index', compact('blogs'));
   }


    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('blogs', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $blog->image;

        if ($request->hasFile('image')) {
        // delete old image if exists
        if ($blog->image && \Storage::disk('public')->exists($blog->image)) {
            \Storage::disk('public')->delete($blog->image);
        }

        // store new one
        $imagePath = $request->file('image')->store('blogs', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
    if ($blog->image && \Storage::disk('public')->exists($blog->image)) {
        \Storage::disk('public')->delete($blog->image);
    }

    $blog->delete();
    return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted.');
    }


    public function publicIndex()
    {
       $blogs = Blog::latest()->get();
        return view('blogs', compact('blogs'));
    }
}
