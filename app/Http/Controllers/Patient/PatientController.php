<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        // $patients = auth()->user()->patients()->get();
        $patients = Patient::all();
        return response()->json([
            'patients' => $patients
        ], 200);
    }

    public function show(Patient $patient)
    {
        return response()->json([
            'patient' => PatientResource::make($patient),
            'history' => $patient->history
        ]);
    }
}
