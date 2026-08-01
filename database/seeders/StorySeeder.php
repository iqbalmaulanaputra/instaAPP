<?php

namespace Database\Seeders;

use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    use GeneratesPlaceholderImages;

    public function run(): void
    {
        $users = User::all();
        $count = min(fake()->numberBetween(4, 8), $users->count());

        $users->random($count)->each(function (User $user) {
            $storyCount = fake()->numberBetween(1, 3);

            for ($i = 0; $i < $storyCount; $i++) {
                $story = new Story([
                    'user_id' => $user->id,
                    'image' => $this->generatePlaceholderImage('stories', '@' . $user->username, 720, 1280),
                ]);

                $story->created_at = now()->subHours(fake()->numberBetween(0, 20));
                $story->save();
            }
        });
    }
}
