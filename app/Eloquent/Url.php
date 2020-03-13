<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Url extends Model
{
    protected $fillable = ['ip', 'short_url', 'long_url', 'total_click'];

    public static function generateShortUrl()
    {
        $slug = Str::random(6);
        $countSlug = self::where('short_url', $slug)->count();

        while($countSlug !== 0) {
            $slug = Str::random(6);
            $countSlug = self::where('short_url', $slug)->count();
        }
        return $slug;
    }
}
