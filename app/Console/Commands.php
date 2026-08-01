<?php

namespace App\Console\Commands;

use App\Models\Story;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PruneExpiredStories extends Command
{
    protected $signature = 'stories:prune';
    protected $description = 'Hapus story yang sudah lewat 24 jam beserta file gambarnya';

    public function handle(): void
    {
        $expired = Story::where('created_at', '<', now()->subDay())->get();

        foreach ($expired as $story) {
            Storage::disk('public')->delete($story->image);
            $story->delete();
        }

        $this->info("Berhasil menghapus {$expired->count()} story kedaluwarsa.");
    }
}
