<?php

namespace App\Http\Controllers\Patient;


use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Http\Requests\StorePatientRequest;

class PatientController extends Controller
{
    public function index()
    {
        $patients = auth()->user()->patients()->get();
        return response()->json([
            'patients' => $patients
        ], 200);
    }

    public function show(Patient $patient)
    {
       
        return response()->json([
            'patient' => PatientResource::make($patient),
            'history' => $patient->history()        
         ]);
       
    }

    public function store(StorePatientRequest $request)
    {
        $request->validated();
        $patient = auth()->user()->patients()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' =>$request->phone_number,
            'birthday' =>$request->birthday,
            'location' =>$request->location,
            'gender'=>$request->gender
          
        ]);

        // return response()->json([
        //     'patient' => $patient,
        // ],200);

        return response()->json([
            'message' => 'patient added successfully',
        ],200);

    }

    public function update(StorePatientRequest $request, Patient $patient)
    {
        
        $request->validated();
        $patient=auth()->user()->patients()->find($patient->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' =>$request->phone_number,
            'birthday' =>$request->birthday,
            'location' =>$request->location,
            'gender'=>$request->gender
        ]);

        // return response()->json([
        //     'patient' => $patient,
        // ],200);

        return response()->json([
            'message' => 'patient updated successfully',
        ],200);
    }


    // public function distroy(Patient $patient)
    // {
    //     $patient=auth()->user()->patients()->find($patient->id)->delete();

    //     // return response()->json([
    //     //     'message' => 'patient deleted successfully',
    //     // ],200);

    //     return response()->json([
    //         'patient' => $patient,
    //     ],200);

    // }
    
}
