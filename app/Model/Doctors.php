<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Doctors extends Eloquent
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
        'address_cep',
        'address_street',
        'address_number',
        'address_complement',
        'country_id',
        'state_id',
        'city_id',
        'allows_docking',
        'cpf',
        'identity',
        'issuance_date',
        'issuing_agency',
        'professional_advice_id',
        'professional_advice_state_id',
        'professional_advice_number',
        'professional_advice_type',
        'cnpj'
    ];
}