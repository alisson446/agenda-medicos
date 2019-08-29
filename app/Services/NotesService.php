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
                            'users.name as user_name'
                        )
                        ->join('users', 'users.id', '=', 'notes.user_id')
                        ->orderBy('updated_at', 'desc')
                        ->where('finished', '=', 0)
                        ->get();

        return $notes;
    }
}