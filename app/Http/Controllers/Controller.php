<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
    
        Post::create($validatedData);
    
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
}
