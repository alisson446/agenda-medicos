<?php
namespace App\Services;
use App\Model\Patients;
class PatientsService extends Service
{
    public function __construct()
    {
        parent::__construct(Patients::class);
    }
}