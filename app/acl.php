<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class acl extends Model
{
    protected $fillable = [
        '_id',
        'email',
        'page',
        'permission'
    ];
}
