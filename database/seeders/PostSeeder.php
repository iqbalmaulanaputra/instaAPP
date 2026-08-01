<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    use GeneratesPlaceholderImages;

    private array $captions = [
        'Sudut favorit buat bersantai di akhir pekan 🌴',
        'Ngopi sore ditemani langit senja ☕️',
        'Liburan singkat, kenangan panjang ✨',
        'Belajar hal baru setiap hari 📚',
        'Suasana pagi yang bikin semangat 🌅',
        'Kulineran sampai kenyang 🍜',
        'Momen kecil yang berharga 💙',
        'Explore tempat baru minggu ini 🧭',
    ];

    public function run(): void
    {
        User::all()->each(function (User $user) {
            $count = fake()->numberBetween(1, 4);

            for ($i = 0; $i < $count; $i++) {
                Post::create([
                    'user_id' => $user->id,
                    'caption' => fake()->boolean(85) ? fake()->randomElement($this->captions) : null,
                    'image' => $this->generatePlaceholderImage('posts', '@' . $user->username),
                ]);
            }
        });
    }
}
