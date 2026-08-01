<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Save;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class InteractionSeeder extends Seeder
{
    private array $commentTexts = [
        'Keren banget suasananya! 😍',
        'Boleh dong lokasi tepatnya di mana?',
        'Aesthetic parah ini mah 🔥',
        'Jadi pengen ke sana juga',
        'Foto favorit minggu ini nih',
        'Wah bagus banget capturenya!',
    ];

    public function run(): void
    {
        $users = User::all();

        Post::all()->each(function (Post $post) use ($users) {
            $others = $users->where('id', '!=', $post->user_id)->values();

            $this->attachRandom($others, fake()->numberBetween(0, 8), function (User $user) use ($post) {
                Like::firstOrCreate([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            });

            $this->attachRandom($others, fake()->numberBetween(0, 3), function (User $user) use ($post) {
                Comment::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                    'comment' => fake()->randomElement($this->commentTexts),
                ]);
            });

            $this->attachRandom($others, fake()->numberBetween(0, 4), function (User $user) use ($post) {
                Save::firstOrCreate([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            });
        });
    }

    private function attachRandom(Collection $collection, int $count, \Closure $callback): void
    {
        $count = min($count, $collection->count());
        if ($count === 0) {
            return;
        }

        $collection->random($count)->each($callback);
    }
}
