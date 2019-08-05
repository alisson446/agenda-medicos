<?php

namespace App\Services;

use App\Model\Specialties;

class SpecialtiesService extends Service
{
    public function __construct()
    {
        parent::__construct(Specialties::class);
    }
}
