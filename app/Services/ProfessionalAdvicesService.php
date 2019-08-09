<?php
namespace App\Services;
use App\Model\ProfessionalAdvices;
class ProfessionalAdvicesService extends Service
{
    public function __construct()
    {
        parent::__construct(ProfessionalAdvices::class);
    }
}