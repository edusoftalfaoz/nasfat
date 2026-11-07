<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageSetting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'announcement_enabled' => 'boolean',
        'show_stats'           => 'boolean',
        'show_anthem'          => 'boolean',
        'about_highlights'     => 'array',
        'admissions_steps'     => 'array',
        'pledge_items'         => 'array',
    ];

    /**
     * The single homepage settings row. Never returns null, so the public
     * page keeps working even before the migration data exists.
     */
    public static function current(): static
    {
        return static::query()->first() ?? new static();
    }

    /** Split a multi-line text value into clean, non-empty lines. */
    public static function lines(?string $text): array
    {
        return array_values(array_filter(
            array_map('trim', preg_split('/\R/', (string) $text) ?: []),
            fn ($line) => $line !== ''
        ));
    }
}
