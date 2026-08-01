<?php

namespace App\View\Composers;

use App\Models\Story;
use App\Models\StoryView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StoriesComposer
{
    public function compose(View $view): void
    {
        $currentUser = Auth::user();

        if (! $currentUser) {
            $view->with([
                'ownHasStories' => false,
                'ownHasUnseen' => false,
                'otherGroups' => collect(),
                'storyGroupsJs' => [],
            ]);
            return;
        }

        $activeStories = Story::query()
            ->active()
            ->with('user')
            ->latest()
            ->get()
            ->groupBy('user_id');

        $viewedIds = StoryView::where('user_id', $currentUser->id)
            ->whereIn('story_id', $activeStories->flatten()->pluck('id'))
            ->pluck('story_id')
            ->all();

        $ownStories = $activeStories->get($currentUser->id, collect());
        $ownHasStories = $ownStories->isNotEmpty();
        $ownHasUnseen = $ownStories->contains(fn($s) => ! in_array($s->id, $viewedIds));

        $otherGroups = collect();
        $jsGroups = [];

        if ($ownHasStories) {
            $jsGroups[] = [
                'userId' => 'own',
                'username' => $currentUser->username,
                'stories' => $ownStories->map(fn($s) => [
                    'id' => $s->id,
                    'image' => Storage::url($s->image),
                ])->values(),
            ];
        }

        foreach ($activeStories as $userId => $stories) {
            if ($userId == $currentUser->id) {
                continue;
            }

            $user = $stories->first()->user;
            $hasUnseen = $stories->contains(fn($s) => ! in_array($s->id, $viewedIds));

            $otherGroups->push([
                'userId' => $userId,
                'username' => $user->username,
                'avatar' => $user->avatar,
                'hasUnseen' => $hasUnseen,
            ]);

            $jsGroups[] = [
                'userId' => (string) $userId,
                'username' => $user->username,
                'stories' => $stories->map(fn($s) => [
                    'id' => $s->id,
                    'image' => Storage::url($s->image),
                ])->values(),
            ];
        }

        $view->with([
            'ownHasStories' => $ownHasStories,
            'ownHasUnseen' => $ownHasUnseen,
            'otherGroups' => $otherGroups->sortByDesc('hasUnseen')->values(),
            'storyGroupsJs' => $jsGroups,
        ]);
    }
}
