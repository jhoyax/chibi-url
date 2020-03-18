<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class UrlClick extends Model
{
    protected $fillable = ['ip', 'referer', 'user_agent'];
}
