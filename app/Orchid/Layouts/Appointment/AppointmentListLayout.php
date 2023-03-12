<?php

namespace App\Orchid\Layouts\Appointment;

use Carbon\Carbon;
use Orchid\Screen\TD;
use App\Models\Appointment;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class AppointmentListLayout extends Table
{
    protected $target = 'appointments';

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id'),
            TD::make('patient_id', 'Patient')
                ->render(function (Appointment $appointment) {
                    return Link::make($appointment->patient->name)
                        ->route('platform.system.patient.show', $appointment->patient_id);
                }),
            TD::make('date', 'Date'),
            TD::make('time', 'Time')
                ->render(function (Appointment $appointment) {
                    return Carbon::parse($appointment->time)->format('g:i A');
                }),
            TD::make('completed', 'Completed')
                ->render(function (Appointment $appointment) {
                    return $appointment->completed
                        ? view('utils.icon', ['icon' => 'check', 'class' => 'text-success'])
                        : view('utils.icon', ['icon' => 'clock', 'class' => 'text-warning']);
                }),
            TD::make(__('Actions'))
                ->render(function (Appointment $appointment) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.system.appointment', $appointment->id)
                                ->icon('pencil')
                                ->canSee($appointment->user_id == auth()->id()),
                            Button::make(__('Complete'))
                                ->icon('check')
                                ->method('complete', [
                                    'id' => $appointment->id
                                ])
                                ->canSee(!$appointment->completed)
                    ]);
                }
            ),
        ];
    }
}
