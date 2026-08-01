<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('q', ''));

        $posts = Post::with('user')
            ->withCount(['likes', 'comments'])
            ->when($query !== '', function ($q) use ($query) {
                $q->where('caption', 'like', "%{$query}%")
                    ->orWhereHas('user', fn($u) => $u->where('username', 'like', "%{$query}%"));
            })
            ->latest()
            ->get();

        return view('explore.index', compact('posts', 'query'));
    }
}
