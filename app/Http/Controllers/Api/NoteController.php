<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
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
        try {
            $data = $this->validate($request, [
                'name' => 'required',
                'content' => 'nullable',
                'done' => 'required'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating note', 'error' => $e->getMessage()], 500);
        }
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
    public function update(Request $request, $id)
    {
       try {
            $data = $this->validate($request, [
                'name' => 'required',
                'content' => 'nullable',
                'done' => 'required'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating note', 'error' => $e->getMessage()], 500);
        }
        //$user = Auth::user();
        $note = Note::findOrFail($id);
        //$note->user_id = $user->id;
        $note->update($data);
        return response()->json(['message' => 'Note updated successfully', 'note' => $note], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return response()->json(['message' => 'Note deleted successfully'], 201);
    }
}
