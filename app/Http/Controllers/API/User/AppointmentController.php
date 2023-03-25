<?php

namespace App\Http\Controllers\API\User;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = auth()->user()->appointments()->get();
        return response()->success([
            'appointments' => AppointmentResource::collection($appointments)
            ],'success.', 200);
    }

    public function store(StoreAppointmentRequest $request)
    {
        auth()->user()->appointments()->create($request->validated());
        return response()->info('created.', 201);
    }

    public function update(UpdateAppointmentRequest $request, int $id)
    {
        try {
            $appointment = auth()->user()->appointments()->findOrFail($id);
            $appointment->update($request->validated());
        } catch (ModelNotFoundException) {
            return response()->info('not found.', 404);
        }
        return response()->info('updated.', 200);
    }

    public function destroy(int $id)
    {
        try {
            $appointment = auth()->user()->appointments()->findOrFail($id);
            $appointment->delete();
        } catch (ModelNotFoundException) {
            return response()->info('not found.', 404);
        }
        return response()->info('removed.', 200);
    }

    public function complete(Appointment $appointment)
    {
        $appointment->completed = 1;
        $appointment->save();
        return response()->info('updated.', 200);
    }

    public function upcoming()
    {
        $upcoming_appointments = auth()->user()->appointments()->pending()->upcoming()->get();
        return response()->success([
            'upcoming_appointments' => AppointmentResource::collection($upcoming_appointments)
            ],'success.', 200);
    }
}
