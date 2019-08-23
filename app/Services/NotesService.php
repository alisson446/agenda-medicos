<?php
namespace App\Services;
use App\Model\Notes;

class NotesService extends Service
{
    public function __construct()
    {
        parent::__construct(Notes::class);
    }

    public function getNotesDetailed()
    {
        $notes = Notes::
                        select(
                            'notes.*',
                            'patients.name as patient_name',
                            'doctors.name as doctor_name'
                        )
                        ->join('patients', 'patients.id', '=', 'notes.patient_id')
                        ->join('doctors', 'doctors.id', '=', 'notes.doctor_id')
                        ->orderBy('updated_at', 'desc')
                        ->get();

        return $notes;
    }
}