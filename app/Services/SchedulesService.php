<?php
namespace App\Services;
use App\Model\Schedules;
use Illuminate\Support\Facades\DB;
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

    public function getByDoctorPeriod($doctor_ids, $date, $time)
    {
        $schedules = DB::select("
                        select * from schedules
                        where
                            doctor_id = $doctor_ids and
                            (
                                '$date' between STR_TO_DATE(initial_date, '%d/%m/%Y') and STR_TO_DATE(finish_date, '%d/%m/%Y') and
                                '$time' between initial_hour and finish_hour
                            )
                    ");

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
                        ->orderBy('initial_date')
                        ->get();

        return $schedules;
    }
}
