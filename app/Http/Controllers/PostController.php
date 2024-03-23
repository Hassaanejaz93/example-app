<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id); // Find the post by its ID

        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($validatedData); // Update the post with validated data

        return response()->json($post); // Return the updated post as JSON response
    }
}
