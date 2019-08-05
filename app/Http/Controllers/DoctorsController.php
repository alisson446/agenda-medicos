<?php

namespace App\Http\Controllers;

use App\Services\DoctorsService;
use App\Services\DoctorsSpecialtiesService;
use App\Services\ProfessionalAdvicesService;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    protected $doctorsService;
    protected $professionalAdvicesService;
    protected $doctorsSpecialtiesService;

    public function __construct(DoctorsService $doctorsService, ProfessionalAdvicesService $professionalAdvicesService, DoctorsSpecialtiesService $doctorsSpecialtiesService)
    {
        $this->doctorsService = $doctorsService;
        $this->professionalAdvicesService = $professionalAdvicesService;
        $this->doctorsSpecialtiesService = $doctorsSpecialtiesService;
    }

    public function index(Request $request)
    {
//        $redirect = $request->get('redirect');
//        if (isset($redirect)) {
//            $redirect = $redirect == "server" ? "painel" : $redirect;
//            return redirect()->route($redirect, []);
//        }

        return view("doctors.index");
    }

    public function getDoctors()
    {
        $doctors = $this->doctorsService->getAll();
        foreach ($doctors as $key => $doctor) {
            $doctors[$key]['specialties'] = [];
            $specialties = $this->doctorsSpecialtiesService->getAllByDoctorId($doctor['id']);
            $doctors[$key]['specialties'] = $specialties;
        }
        return $doctors;
    }

    public function makeAdd(Request $request)
    {
        $id = $request->get("id");
        $specialties = $request->get("specialties");

        if ($id) {
            $this->doctorsService->update($request->all(), $id);
            if (count($specialties) > 0) {
                $this->doctorsSpecialtiesService->deleteByDoctorId(['doctor_id' => $id]);
                foreach ($specialties as $specialty) {
                    $this->doctorsSpecialtiesService->create(['specialty_id' => $specialty['id'], 'doctor_id' => $id]);
                }
            }
        } else {
            $res = $this->doctorsService->create($request->all());

            if (count($specialties) > 0) {
                foreach ($specialties as $specialty) {
                    $this->doctorsSpecialtiesService->create(['specialty_id' => $specialty['id'], 'doctor_id' => $res['id']]);
                }
            }
        }

        $doctors = $this->doctorsService->getAll();
        foreach ($doctors as $key => $doctor) {
            $doctors[$key]['specialties'] = [];
            $specialties = $this->doctorsSpecialtiesService->getAllByDoctorId($doctor['id']);
            $doctors[$key]['specialties'] = $specialties;
        }
        return $doctors;
    }

    public function delete($id)
    {
        $this->doctorsSpecialtiesService->deleteByDoctorId($id);
        $this->doctorsService->delete($id);
    }

    public function getProfessionalAdvices()
    {
        return $this->professionalAdvicesService->getAll();
    }
}