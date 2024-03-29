<?php

namespace App\Http\Controllers\API\User;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PatientController extends Controller
{
    public function index()
    {
        $patients = auth()->user()->patients()->get(['name', 'email', 'created_at', 'last_viewed_at']);
        return response()->success(
            ['patients' => PatientResource::collection($patients)], 'success.', 200
        );
    }

    public function show($id)
    {
        try {
            $patient = auth()->user()->patients()->findOrFail($id);
            // $patient->last_viewed_at = now();
            // $patient->save();
        } catch (ModelNotFoundException) {
            return response()->error('not found.', 404);
        }
        return response()->success(['patient' => PatientResource::make($patient)], 'success.', 200);
    }

    public function search(string $search)
    {
        return PatientResource::collection(Patient::whereLike('name', $search)
            ->whereLike('email', $search)
            ->get());
    }
}
