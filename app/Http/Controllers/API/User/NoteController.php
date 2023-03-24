<?php

namespace App\Http\Controllers\API\User;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use App\Http\Requests\StoreNoteRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NoteController extends Controller
{
    public function index()
    {
        $notes = auth()->user()->notes()->get();
        return response()->success(['notes' => NoteResource::collection($notes)], 'success.', 200);
    }

    public function store(StoreNoteRequest $request)
    {
        $note = auth()->user()->notes()->create($request->validated());
        return response()->success(['note' => NoteResource::make($note)], 'created.', 201);
    }

    public function update(Request $request, int $id)
    {
        try {
            $note = auth()->user()->notes()->findOrFail($id);
            $note->update([
                'body' => $request->body
            ]);
        } catch (ModelNotFoundException){
            return response()->info('not found.', 404);
        }
        return response()->success(['note' => NoteResource::make($note)], 'updated.', 200);
    }

    public function destroy(int $id)
    {
        try {
            $note = auth()->user()->notes()->findOrFail($id)->delete();
        } catch (ModelNotFoundException) {
            return response()->info('not found.', 404);
        }
        return response()->info('removed.', 200);
    }
}
