<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Rooms extends Eloquent
{
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'name'
    ];
}