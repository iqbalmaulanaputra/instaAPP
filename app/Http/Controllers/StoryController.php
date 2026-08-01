<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoryRequest;
use App\Models\Story;
use App\Models\StoryView;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    public function store(StoreStoryRequest $request)
    {
        $request->user()->stories()->create([
            'image' => $request->file('image')->store('stories', 'public'),
        ]);

        return response()->json([
            'message' => 'Story berhasil dibagikan.',
        ]);
    }

    public function markViewed(Story $story)
    {
        StoryView::firstOrCreate([
            'user_id' => Auth::id(),
            'story_id' => $story->id,
        ]);

        return response()->json(['message' => 'ok']);
    }
}
