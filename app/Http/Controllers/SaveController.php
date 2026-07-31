<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Save;

use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function toggle(Post $post)
    {
        $save = Save::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->first();

        if ($save) {
            $save->delete();
            $saved = false;
        } else {
            Save::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
            ]);
            $saved = true;
        }

        return response()->json(['saved' => $saved]);
    }
}
