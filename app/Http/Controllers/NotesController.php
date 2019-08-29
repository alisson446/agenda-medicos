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
        $user_id = $request->get("user_id");
        $note = $request->get("note");
        $reminderDate = $request->get("reminderDate");
        $reminderHour = $request->get("reminderHour");

        $data = [
            "id" => $id,
            "user_id" => $user_id,
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

    public function finish(Request $request, $id)
    {
        $finished = $request->get("finished");

        $data = [ "finished" => $finished ];
        $this->notesService->update($data, $id);

        return $this->notesService->getNotesDetailed();
    }

    public function delete($id)
    {
        $this->notesService->delete($id);
    }

}