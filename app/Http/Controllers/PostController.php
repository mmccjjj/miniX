<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    public function getMyPosts(Request $request)
    {

        $post = post::where('user_id', '=', $request->user()->id)->get();
        return response()->json(['posts' => $post], 200);
    }

    public function getByUserID(Request $request, $user_id)
    {

        $post = post::where('user_id', '=', $user_id)->get();
        return response()->json(['posts' => $post], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',


        ]);

        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => $request->user()->id,
        ]);
        return response()->json(['message' => 'Post created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $post = Post::find($id);
        return response()->json($post, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $post = Post::findOrFail($id);

        if ($request->user()->id !== $post->user->id) {
            return response()->json(['message' => 'You are not the owner!'], 401);
        }

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content']
        ]);

        $post->save();

        return response()->json(['message' => 'Post updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($request->user()->id !== $post->user->id) {
            return response()->json(['message' => 'You are not the owner!'], 401);
        }

        $post->delete();
        return response()->json(['message' => 'Pos deletedsuccesfully'], 204);
    }
}
