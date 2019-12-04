<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $keyType = 'BigInt';
    public $timestamps = true;
}
