<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seiyuu extends Model
{
    protected $fillable = [
        'seiyuu', 'seiyuu_jp', 'comment'
    ];

    protected $table = 'seiyuu';

    public $timestamps = false;
}
