<?php

namespace App\Http\Controllers\appointment;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAppointmentRequest;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = auth()->user()->appointments()->get();
        return response()->json([
            'appointments' => $appointments
        ], 200);
    }

    public function store(Request $request)
    {
        $appointment=auth()->user()->appointments()->create([
            'date'=>$request->date,
            'time'=>$request->time,
            'completed'=>$request->boolean("completed"),
            'notes'=>$request->notes,
            'patient_id'=>$request->patient_id
        ]);

        return response()->json([
            'message' => 'appointment reserved successfully',
        ],200);
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $request->validated();
        $appointment=auth()->user()->appointments()->find($appointment->id)->update([
            'date'=>$request->date,
            'time'=>$request->time,
            'completed'=>$request->boolean("completed"),
            'notes'=>$request->notes
       
        ]);

        return response()->json([
            'message' => 'treatment updated successfully',
        ],200);
    }

    public function distroy(Appointment $appointment)
    {
        $appointment=auth()->user()->appointments()->find($appointment->id)->delete();

        return response()->json([
            'message' => 'appointment deleted successfully',
        ],200);
    }
}
