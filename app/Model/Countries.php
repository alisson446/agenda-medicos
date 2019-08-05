<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Countries extends Eloquent
{
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'name'
    ];
}