<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        'user_id',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(StoryView::class);
    }

    public function isViewedBy(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->views()->where('user_id', $userId)->exists();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('created_at', '>=', now()->subDay());
    }
}
