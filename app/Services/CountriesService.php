<?php
namespace App\Services;
use App\Model\Countries;
class CountriesService extends Service
{
    public function __construct()
    {
        parent::__construct(Countries::class);
    }
}