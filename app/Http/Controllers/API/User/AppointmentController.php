<?php

namespace App\Http\Controllers\API\User;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;

class AppointmentController extends Controller
{
    public function index()
    {
        $coming_appointments = auth()->user()->appointments()->pending()->get();
        return response()->success([
            'coming_appointments' => AppointmentResource::collection($coming_appointments)
            ],'success.', 200);
    }

    public function complete(Appointment $appointment)
    {
        $appointment->completed = 1;
        $appointment->save();

        return response()->info('updated.', 200);
    }
}
