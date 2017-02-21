<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $fillable = [
        'title', 'title_jp', 'comment'
    ];

    protected $table = 'titles';

    public $timestamps = false;
}
