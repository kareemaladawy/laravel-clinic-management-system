<?php

namespace App\Http\Controllers\detection;

use App\Models\Detection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetectionController extends Controller
{
    public function index()
    {
        $detections = auth()->user()->detections()->get();
        return response()->json([
            'detections' => $detections
        ], 200);
    }

    // public function update(Request $request, Detection $detection)
    // {
    //     $patient=auth()->user()->detections()->find($detection->id)->update([
    //         'disease' => $request->disease,
    //         'state' => $request->state,
    //         'type' =>$request->type,
    //         'comments' =>$request->comments,
            
    //     ]);

    //     return response()->json([
    //         'message' => 'detection updated successfully',
    //     ],200);
    // }
}
