<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $myPosts = $user->posts()
            ->withCount(['likes', 'comments'])
            ->latest()
            ->get();

        $savedPosts = Post::with('user')
            ->withCount(['likes', 'comments'])
            ->whereHas('saves', fn($query) => $query->where('user_id', $user->id))
            ->latest()
            ->get();

        $followers = $user->followers()->latest('follows.created_at')->get();
        $following = $user->following()->latest('follows.created_at')->get();

        return view('profile.index', compact('myPosts', 'savedPosts', 'followers', 'following'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $data = $request->safe()->except('avatar');

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return response()->json([
            'message' => 'Profil berhasil diperbarui.',
        ]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->validated()['password']),
        ]);

        return response()->json([
            'message' => 'Kata sandi berhasil diperbarui.',
        ]);
    }
}
