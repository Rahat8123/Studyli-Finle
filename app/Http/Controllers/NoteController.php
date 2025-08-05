<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Auth;

class NoteController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'lecture_id' => 'required|exists:course_lectures,id',
        'note' => 'required|string',
    ]);

    $note = Note::create([
        'user_id' => auth()->id(),
        'lecture_id' => $request->lecture_id,
        'note' => $request->note,
    ]);

    return response()->json(['success' => true, 'message' => 'Note saved successfully!']);
}


  public function destroy($id)
{
    $note = Note::where('id', $id)->where('user_id', auth()->id())->first();

    if ($note) {
        $note->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}


public function getNote($lecture_id)
{
    $notes = Note::where('user_id', auth()->id())
                ->where('lecture_id', $lecture_id)
                ->latest()
                ->get();

    return response()->json($notes);
}

}
