<?php

namespace App\View\Composers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SuggestionsComposer
{
    public function compose(View $view): void
    {
        if (! Auth::check()) {
            $view->with('suggestions', collect());
            return;
        }

        $followingIds = Auth::user()->following()->pluck('users.id')->push(Auth::id());

        $suggestions = User::whereNotIn('id', $followingIds)
            ->latest()
            ->take(5)
            ->get();

        $view->with('suggestions', $suggestions);
    }
}
