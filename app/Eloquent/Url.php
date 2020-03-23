<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Url extends Model
{
    protected $fillable = ['title', 'short_url', 'long_url', 'total_click'];

    public static function generateShortUrl()
    {
        $slug = Str::random(6);
        $countSlug = self::whereShortUrl($slug)->count();

        while ($countSlug !== 0) {
            $slug = Str::random(6);
            $countSlug = self::whereShortUrl($slug)->count();
        }
        return $slug;
    }

    public function scopeFindByShortUrl($query, $slug)
    {
        $query->whereShortUrl($slug);

        return $query;
    }

    /**
     * Get all of the url clicks.
     */
    public function urlClicks()
    {
        return $this->hasMany(UrlClick::class);
    }
}
