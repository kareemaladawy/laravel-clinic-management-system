<?php

namespace App\Http\Controllers\API\User;

use App\Models\Treatment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = auth()->user()->treatments()->get();
        return response()->json([
            'treatments' => $treatments
        ], 200);
    }

    public function store(Request $request)
    {
        $treatment=auth()->user()->treatments()->create([
            'body'=>$request->body,
            'patient_id'=>$request->patient_id
        ]);

        return response()->json([
            'message' => 'treatment added successfully',
        ],200);
    }

    public function update(Request $request, Treatment $treatment)
    {
        $treatment=auth()->user()->treatments()->find($treatment->id)->update([
            'body'=>$request->body

        ]);

        return response()->json([
            'message' => 'treatment updated successfully',
        ],200);
    }

    public function distroy(Treatment $treatment)
    {
        $treatment=auth()->user()->treatments()->find($treatment->id)->delete();

        return response()->json([
            'message' => 'treatment deleted successfully',
        ],200);
    }
}
