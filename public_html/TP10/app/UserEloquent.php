<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEloquent extends Model
{
    protected $table = 'UserEloquent';
    protected $primaryKey = 'id';
    protected $keyType = 'BigInt';
    public $timestamps = false;
}
