<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEloquent extends Model
{
    protected $table = 'UserEloquent';
    protected $primaryKey = 'user';
    protected $keyType = 'string';
    public $timestamps = false;
}
