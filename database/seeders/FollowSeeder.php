<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $others = $users->where('id', '!=', $user->id)->values();
            if ($others->isEmpty()) {
                continue;
            }

            $count = min(fake()->numberBetween(2, 6), $others->count());

            $others->random($count)->each(function (User $target) use ($user) {
                Follow::firstOrCreate([
                    'follower_id' => $user->id,
                    'following_id' => $target->id,
                ]);
            });
        }
    }
}
