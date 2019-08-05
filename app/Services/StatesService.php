<?php
namespace App\Services;
use App\Model\States;
class StatesService extends Service
{
    public function __construct()
    {
        parent::__construct(States::class);
    }
}