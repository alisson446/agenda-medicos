<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Cities extends Eloquent
{
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'name',
        'ibge_code',
        'state_id'
    ];
}