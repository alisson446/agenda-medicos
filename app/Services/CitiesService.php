<?php
namespace App\Services;
use App\Model\Cities;
class CitiesService extends Service
{
    public function __construct()
    {
        parent::__construct(Cities::class);
    }
}