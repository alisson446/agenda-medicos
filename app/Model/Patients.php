<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Patients extends Eloquent
{
    protected $connection = 'mysql';
    protected $fillable = [
        'id',
        'name',
        'email',
        'gender',
        'birthday_date',
        'phone_number',
        'cell_number',
        'observation',
        'plan',
        'plan_card_number',
        'plan_card_valid',
        'address_cep',
        'address_street',
        'address_number',
        'address_complement',
        'country_id',
        'state_id',
        'city_id',
        'phonetic_name',
        'job',
        'cpf',
        'civil_status',
        'mother_name',
        'mother_job',
        'father_name',
        'father_job',
        'identity',
        'issuance_date',
        'issuing_agency',
        'num_birth_registration',
        'blood_type',
        'cns'
    ];
}