<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Note::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $this->validate($request, [
            'name' => 'required',
            'done' => 'required'
        ]);
        $note = new Note();
        $note->fill($data);
        $note->user_id = $user->id;
        $note->save();
        return response()->json(['message' => 'Note created successfully', 'note' => $note], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Note::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $user = Auth::user();
        $data = $this->validate($request, [
            'name' => 'required',
            'done' => 'required'
        ]);
        $note->update($data);
        $note->user_id = $user->id;
        $note->save();
        return response()->json(['message' => 'Note updated successfully', 'note' => $note], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
