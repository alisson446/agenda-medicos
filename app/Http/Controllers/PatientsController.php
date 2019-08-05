<?php

namespace App\Http\Controllers;

use App\Services\PatientsService;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    protected $patientsService;

    public function __construct(PatientsService $patientsService)
    {
        $this->patientsService = $patientsService;
    }

    public function index(Request $request)
    {
//        $redirect = $request->get('redirect');
//        if (isset($redirect)) {
//            $redirect = $redirect == "server" ? "painel" : $redirect;
//            return redirect()->route($redirect, []);
//        }

        return view("patients.index");
    }

    public function getPatients()
    {
        return $this->patientsService->getAll();
    }

    public function makeAdd(Request $request)
    {
        $id = $request->get("id");

        if ($id) {
            $this->patientsService->update($request->all(), $id);
        } else {
            $this->patientsService->create($request->all());
        }

        return $this->patientsService->getAll();
    }

    public function delete($id)
    {
        $this->patientsService->delete($id);
    }
}