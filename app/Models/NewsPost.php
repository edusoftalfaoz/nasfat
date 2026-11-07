<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsPost extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'event_date'   => 'date',
    ];

    protected static function booted(): void
    {
        static::saving(function (NewsPost $post) {
            if (blank($post->slug)) {
                $post->slug = Str::slug($post->title);
            }

            // Make sure the slug is unique even if two posts share a title.
            $base = $post->slug;
            $i = 2;
            while (static::where('slug', $post->slug)->where('id', '!=', $post->id ?? 0)->exists()) {
                $post->slug = $base . '-' . $i++;
            }

            if ($post->is_published && blank($post->published_at)) {
                $post->published_at = now();
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where(fn ($q) => $q->whereNull('published_at')->orWhere('published_at', '<=', now()))
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }

    public function getSummaryAttribute(): string
    {
        return $this->excerpt ?: Str::limit(strip_tags((string) $this->body), 150);
    }
}
