<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoGame extends Model
{
    protected $table = 'video_games';
    protected $primaryKey = 'id';
    protected $keyType = 'BigInt';
    public $timestamps = false;
}
