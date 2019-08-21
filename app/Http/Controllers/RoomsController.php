<?php

namespace App\Http\Controllers;

use App\Services\RoomsService;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    protected $roomsService;

    public function __construct(RoomsService $roomsService)
    {
        $this->roomsService = $roomsService;
    }

    public function index(Request $request)
    {
//        $redirect = $request->get('redirect');
//        if (isset($redirect)) {
//            $redirect = $redirect == "server" ? "painel" : $redirect;
//            return redirect()->route($redirect, []);
//        }

        return view("rooms.index");
    }

    public function getRooms()
    {
        return $this->roomsService->getAll();
    }

    public function makeAdd(Request $request)
    {
        $id = $request->get("id");

        if ($id) {
            $this->roomsService->update($request->all(), $id);
        } else {
            $this->roomsService->create($request->all());
        }

        return $this->roomsService->getAll();
    }

    public function delete($id)
    {
        $this->roomsService->delete($id);
    }

}