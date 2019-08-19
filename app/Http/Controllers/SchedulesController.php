<?php

namespace App\Http\Controllers;

use App\Services\DoctorsService;
use App\Services\PatientsService;
use App\Services\SchedulesService;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    protected $doctorsService;
    protected $patientsService;
    protected $scheduleService;

    public function __construct(DoctorsService $doctorsService, PatientsService $patientsService, SchedulesService $scheduleService)
    {
        $this->doctorsService = $doctorsService;
        $this->patientsService = $patientsService;
        $this->scheduleService = $scheduleService;
    }

    public function index(Request $request)
    {
//        $redirect = $request->get('redirect');
//        if (isset($redirect)) {
//            $redirect = $redirect == "server" ? "painel" : $redirect;
//            return redirect()->route($redirect, []);
//        }

        return view("schedules.index");
    }

    public function getSchedules(Request $request)
    {
        $doctor_id = $request->get("doctor_id");

        $schedules = $this->scheduleService->getAllByDoctorId($doctor_id);
        return $schedules;
    }

    public function makeAdd(Request $request)
    {
        $id = $request->get("id");
        $patient_id = $request->get("patient_id");
        $doctor_id = $request->get("doctor_id");
        $specialty_id = $request->get("specialty_id");
        $initial_date = $request->get("initial_date");
        $finish_date = $request->get("finish_date");
        $initial_hour = $request->get("initial_hour");
        $finish_hour = $request->get("finish_hour");
        $plan = $request->get("plan");
        $value = $request->get("value");

        $patient = $this->patientsService->find($patient_id);
        $data = [
            "id" => $id,
            "patient_id" => $patient_id,
            "doctor_id" => $doctor_id,
            "specialty_id" => $specialty_id,
            "initial_date" => $initial_date,
            "finish_date" => $finish_date,
            "initial_hour" => $initial_hour,
            "finish_hour" => $finish_hour,
            "plan" => $plan,
            "value" => $value,
            "title" => $patient->name,
            "start" => SchedulesService::formatDate($initial_date, $initial_hour),
            "end" => SchedulesService::formatDate($finish_date, $finish_hour)
        ];

        if ($id) {
            $dataSaved = $this->scheduleService->update($data, $id);
        } else {
            unset($data["id"]);
            $dataSaved = $this->scheduleService->create($data);
        }

        return $dataSaved;
    }

    public function delete(Request $request)
    {
        $id = $request->get("schedule_id");
        $doctor_id = $request->get("doctor_id");

        $this->scheduleService->delete($id);
        return $doctor_id;
    }

}
