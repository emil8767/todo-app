<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class NotePolicy
{
    public function show(User $user, Note $note)
    {
        //$user = Auth::user();
        return $user->id === $note->user_id || $user->role_id === 1000;

    }
}
