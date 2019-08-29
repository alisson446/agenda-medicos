<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Notes extends Eloquent
{
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'doctor_id',
        'patient_id',
        'user_id',
        'note',
        'reminder',
        'finished'
    ];
}