<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post)
    {
        $comment = $post->comments()->create([
            'user_id' => $request->user()->id,
            'comment' => $request->validated()['comment'],
        ]);

        return response()->json([
            'comment' => [
                'username' => $request->user()->username,
                'text' => $comment->comment,
            ],
            'comments_count' => $post->comments()->count(),
        ]);
    }
}
