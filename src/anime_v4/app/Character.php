<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'character', 'character_jp', 'title', 'seiyuu', 'comment'
    ];

    protected $table = 'characters';

    public $timestamps = false;
}
