<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class DoctorsSpecialties extends Eloquent
{
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'specialty_id',
        'doctor_id'
    ];
}