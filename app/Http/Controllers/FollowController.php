<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function toggle(User $user)
    {
        if ($user->id === Auth::id()) {
            return response()->json([
                'message' => 'Anda tidak bisa mengikuti diri sendiri.',
            ], 422);
        }

        $existing = Follow::where('follower_id', Auth::id())
            ->where('following_id', $user->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $following = false;
        } else {
            Follow::create([
                'follower_id' => Auth::id(),
                'following_id' => $user->id,
            ]);
            $following = true;
        }

        return response()->json([
            'following' => $following,
            'followers_count' => $user->followers()->count(),
        ]);
    }
}
