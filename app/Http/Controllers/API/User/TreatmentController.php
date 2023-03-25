<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Resources\TreatmentResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = auth()->user()->treatments()->get();
        return response()->success([
            'treatments' => TreatmentResource::collection($treatments)
        ], 'success.', 200);
    }

    public function show(int $id)
    {
        try {
            $treatment = auth()->user()->treatments()->findOrFail($id);
        } catch (ModelNotFoundException){
            return response()->info('not found.', 404);
        }
        return response()->success(['treatment' => TreatmentResource::make($treatment)], 'success.', 200);
    }

    // public function store(StoreTreatmentRequest $request)
    // {
    //     $treatment = auth()->user()->treatments()->create($request->validated());
    //     return response()->success(['treatment' => TreatmentResource::make($treatment)], 'created.', 201);
    // }

    // public function update(Request $request, int $id)
    // {
    //     try {
    //         $treatment = auth()->user()->treatments()->findOrFail($id);
    //         $treatment->update([
    //             'body' => $request->body
    //         ]);
    //     } catch (ModelNotFoundException){
    //         return response()->info('not found.', 404);
    //     }
    //     return response()->success(['treatment' => TreatmentResource::make($treatment)], 'updated.', 200);
    // }

    // public function destroy(int $id)
    // {
    //     try {
    //         $treatment = auth()->user()->treatments()->findOrFail($id)->delete();
    //     } catch (ModelNotFoundException) {
    //         return response()->info('not found.', 404);
    //     }
    //     return response()->info('removed.', 200);
    // }
}
