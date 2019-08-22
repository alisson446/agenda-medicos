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

    public function getAllByDoctorId($doctor_ids)
    {
        if (!is_array($doctor_ids))
            $doctor_ids = [ $doctor_ids ];

        $schedules = Schedules::whereIn('doctor_id', $doctor_ids)->get();
        return $schedules;
    }

    public function getWaitinglistByDoctorId($doctor_ids)
    {
        if (!is_array($doctor_ids))
            $doctor_ids = [ $doctor_ids ];

        $schedules = Schedules::
                        select(
                            'schedules.*',
                            'patients.name as patient_name',
                            'specialties.name as specialtie_name'
                        )
                        ->join('patients', 'patients.id', '=', 'schedules.patient_id')
                        ->join('specialties', 'specialties.id', '=', 'schedules.specialty_id')
                        ->whereIn('doctor_id', $doctor_ids)
                        ->get();

        return $schedules;
    }
}
