<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Schedules extends Eloquent
{
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'specialty_id',
        'doctor_id',
        'patient_id',
        'initial_date',
        'finish_date',
        'initial_hour',
        'finish_hour',
        'value',
        'title',
        'start',
        'end',
        'plan'
    ];
}
