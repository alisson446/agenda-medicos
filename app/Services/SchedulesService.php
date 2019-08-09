<?php
namespace App\Services;
use App\Model\Schedules;
class SchedulesService extends Service
{
    public function __construct()
    {
        parent::__construct(Schedules::class);
    }

    public static function formatDate($date, $hour){
        $year = explode("/", $date)[2];
        $month = explode("/", $date)[1];
        $day = explode("/", $date)[0];

        return "$year-$month-$day $hour";
    }

    public function getAllByDoctorId($doctor_id)
    {
        $schedules = Schedules::where('doctor_id', $doctor_id)->get();
        return $schedules;
    }
}
