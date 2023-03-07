<?php

namespace App\Orchid\Layouts\Appointment;

use Carbon\Carbon;
use Orchid\Screen\TD;
use App\Models\Appointment;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class AppointmentListLayout extends Table
{
    protected $target = 'appointments';

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id')
                ->render(function (Appointment $appointment) {
                    return Link::make($appointment->id)
                        ->route('platform.system.appointment', $appointment);
                }),
            TD::make('patient_id', 'Patient')
                ->render(function (Appointment $appointment) {
                    return Link::make($appointment->patient->name)
                        ->route('platform.system.patient', $appointment->patient_id);
                }),
            TD::make('date', 'Date')
                ->render(function (Appointment $appointment) {
                    return Link::make($appointment->date)
                        ->route('platform.system.appointment', $appointment);
                }),
            TD::make('time', 'Time')
                ->render(function (Appointment $appointment) {
                    return Carbon::parse($appointment->time)->format('g:i A');
                }),
            TD::make('completed', 'State')
                ->render(function (Appointment $appointment) {
                    return $appointment->completed ? 'completed' : 'pending';
                })
                ->filter(),
            TD::make('created_at', 'Created at')
                ->sort()->filter()
                ->render(function (Appointment $appointment) {
                    return Carbon::parse($appointment->created_at)->format('g:i A');
                }),
            TD::make('updated_at', 'Last edit at')
                ->sort()->filter()
                ->render(function (Appointment $appointment) {
                    return Carbon::parse($appointment->updated_at)->format('g:i A');
                }),
        ];
    }
}
