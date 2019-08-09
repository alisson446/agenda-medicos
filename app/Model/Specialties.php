<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Specialties extends Eloquent
{
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'name'
    ];
}