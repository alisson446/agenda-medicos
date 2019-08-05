<?php

namespace App\Services;

use App\Model\DoctorsSpecialties;
use App\Model\Specialties;

class DoctorsSpecialtiesService extends Service
{
    public function __construct()
    {
        parent::__construct(DoctorsSpecialties::class);
    }

    public function deleteByDoctorId($doctor_id)
    {
        return DoctorsSpecialties::where('doctor_id', $doctor_id)->delete();
    }

    public function getAllByDoctorId($doctor_id)
    {
        $specialties = [];
        $doctor_specialties = DoctorsSpecialties::where('doctor_id', $doctor_id)->get();
        foreach ($doctor_specialties as $doctor_specialty){
            $find = Specialties::where('id', $doctor_specialty['specialty_id'])->first();
            if($find){
                array_push($specialties,["id" => $find['id'],"name" => $find['name']]);
            }
        }
        return $specialties;
    }
}