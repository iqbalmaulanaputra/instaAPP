<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->withCount(['likes', 'comments'])
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $request->user()->posts()->create([
            'caption' => $data['caption'] ?? null,
            'image' => $request->file('image')->store('posts', 'public'),
        ]);

        return response()->json([
            'message' => 'Postingan berhasil dibagikan.',
        ]);
    }
}
