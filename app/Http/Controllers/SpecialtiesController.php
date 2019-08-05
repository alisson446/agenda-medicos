<?php


namespace App\Http\Controllers;

use App\Services\SpecialtiesService;
use Illuminate\Http\Request;

class SpecialtiesController extends Controller
{
    protected $specialtiesService;

    public function __construct(SpecialtiesService $specialtiesService)
    {
        $this->specialtiesService = $specialtiesService;
    }

    public function index(Request $request)
    {
//        $redirect = $request->get('redirect');
//        if (isset($redirect)) {
//            $redirect = $redirect == "server" ? "painel" : $redirect;
//            return redirect()->route($redirect, []);
//        }

        return view("specialties.index");
    }

    public function getSpecialties()
    {
        return $this->specialtiesService->getAll();
    }

    public function makeAdd(Request $request)
    {
        $id = $request->get("id");

        if ($id) {
            $this->specialtiesService->update($request->all(), $id);
        } else {
            $this->specialtiesService->create($request->all());
        }

        return $this->specialtiesService->getAll();
    }

    public function delete($id)
    {
        $this->specialtiesService->delete($id);
    }

}