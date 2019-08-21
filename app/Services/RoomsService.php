<?php
namespace App\Services;
use App\Model\Rooms;

class RoomsService extends Service
{
    public function __construct()
    {
        parent::__construct(Rooms::class);
    }
}