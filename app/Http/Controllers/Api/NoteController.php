<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Mail\NoteMail;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Events\NoteCreated;
use Illuminate\Support\Facades\Mail;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if(isset($user->role) && $user->role->name === 'admin') {
            $notes = Note::all();
            return response()->json(['notes' => $notes], 201);
        } else {
            $notes = $user->notes;
            return response()->json(['notes' => $notes], 201);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validator = $this::validate($request, [
            'name' => 'required|max:255',
            'content' => 'nullable',
            'done' => 'required|boolean'
        ]);
        $note = new Note();
        $note->fill($validator);
        $note->user_id = $user->id;
        $note->save();
        event(new NoteCreated($user->email, $note->name));
        return response()->json(['message' => 'Note created successfully', 'note' => $note], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Auth::user()->notes()->whereId($id)->first();
        return response()->json($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);
        $user = Auth::user();
        if(isset($user->role) && $user->role->name === 'admin' || Auth::user()->id === $note->user_id) {
            $validator = $this::validate($request, [
                'name' => 'required|max:255',
                'content' => 'nullable',
                'done' => 'required|boolean'
            ]);
            $note->update($validator);
            return response()->json(['message' => 'Note updated successfully', 'note' => $note], 201);
        } else {
            return response()->json(['message' => 'The note does not exist or you do not have access',], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $user = Auth::user();
        if(isset($user->role) && Auth::user()->role->name === 'admin' || Auth::user()->id === $note->user_id) {
            $note->delete();
            return response()->json(['message' => 'Note deleted successfully'], 201);
        } else {
            return response()->json(['message' => 'The note does not exist or you do not have access',], 403);
        }
    }
}
