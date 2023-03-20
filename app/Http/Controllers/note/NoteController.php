<?php

namespace App\Http\Controllers\note;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    public function index()
    {
        $notes= auth()->user()->notes()->get();
        return response()->json([
            'notes' => $notes
        ], 200);
    }

    public function store(Request $request)
    {
        $treatment=auth()->user()->notes()->create([
            'body'=>$request->body,
            'patient_id'=>$request->patient_id
        ]);

        return response()->json([
            'message' => 'note added successfully',
        ],200);
    }

    public function update(Request $request, Note $note)
    {
        $note=auth()->user()->notes()->find($note->id)->update([
            'body'=>$request->body
       
        ]);

        return response()->json([
            'message' => 'note updated successfully',
        ],200);
    }

    public function distroy(Note $note)
    {
        $note=auth()->user()->notes()->find($note->id)->delete();

        return response()->json([
            'message' => 'note deleted successfully',
        ],200);
    }
}
