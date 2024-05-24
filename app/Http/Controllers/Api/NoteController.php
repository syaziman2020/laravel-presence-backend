<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    //index
    public function index(Request $request)
    {

        try {

            $notes = Note::where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();

            return response()->json([
                "notes" => $notes,
            ], 200);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    //store
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'note' => 'required',
            ]);

            $note = new Note();
            $note->user_id = $request->user()->id;
            $note->title = $request->title;
            $note->note = $request->note;
            $note->save();

            return response()->json(['message' => 'Note created succesfully'], 201);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
