<?php
namespace App\Services;
use App\Model\Doctors;
class DoctorsService extends Service
{
    public function __construct()
    {
        parent::__construct(Doctors::class);
    }
}