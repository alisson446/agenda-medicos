<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class States extends Eloquent
{
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'name',
        'abbreviation',
        'country_id'
    ];
}