<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request; // Make sure to import the correct Request class

class NoteController extends Controller
{
    //function to read note by id
    public function show($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }

        return response()->json($note);
    }

    //function to read all notes
    public function index()
    {
        $notes = Note::all();

        return response()->json($notes);
    }

    //function to add note
    public function customStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $note = Note::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return response()->json($note, 201); // 201 Created status code
    }
    //function to update note by id
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $note = Note::find($id);

        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }

        $note->title = $request->input('title');
        $note->description = $request->input('description');
        $note->save();

        return response()->json($note);
    }
    //function to delete note by id
    public function destroy($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return response()->json(['error' => 'Note not found'], 404);
        }

        $note->delete();

        return response()->json(['message' => 'Note deleted successfully']);
    }
}
