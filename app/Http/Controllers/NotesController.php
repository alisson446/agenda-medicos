<?php

namespace App\Http\Controllers;

use App\Services\NotesService;
use App\Services\SchedulesService;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    protected $notesService;

    public function __construct(NotesService $notesService)
    {
        $this->notesService = $notesService;
    }

    public function index(Request $request)
    {
//        $redirect = $request->get('redirect');
//        if (isset($redirect)) {
//            $redirect = $redirect == "server" ? "painel" : $redirect;
//            return redirect()->route($redirect, []);
//        }

        return view("notes.index");
    }

    public function getNotes()
    {
        return $this->notesService->getNotesDetailed();
    }

    public function makeAdd(Request $request)
    {
        $id = $request->get("id");
        $patient_id = $request->get("patient_id");
        $doctor_id = $request->get("doctor_id");
        $note = $request->get("note");
        $reminderDate = $request->get("reminderDate");
        $reminderHour = $request->get("reminderHour");

        $data = [
            "id" => $id,
            "patient_id" => $patient_id,
            "doctor_id" => $doctor_id,
            "note" => $note,
            "reminder" => SchedulesService::formatDate($reminderDate, $reminderHour),
        ];

        if ($id) {
            $this->notesService->update($data, $id);
        } else {
            unset($data["id"]);
            $this->notesService->create($data);
        }

        return $this->notesService->getNotesDetailed();
    }

    public function delete($id)
    {
        $this->notesService->delete($id);
    }

}