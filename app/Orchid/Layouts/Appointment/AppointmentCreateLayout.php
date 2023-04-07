<?php

namespace App\Orchid\Layouts\Appointment;

use App\Models\Patient;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class AppointmentCreateLayout extends Rows
{
    protected $target = '';

    protected function fields(): iterable
    {
        return [
            Select::make('appointment.patient_id')
                ->fromQuery(Patient::where('created_by', auth()->id()), 'name')
                ->required()
                ->empty()
                ->title('Choose patient'),

            Input::make('appointment.date')
                ->type('date')
                ->required()
                ->title(__('Date'))
                ->placeholder(__('Date')),

            Input::make('appointment.time')
                ->type('time')
                ->required()
                ->title(__('Time'))
                ->placeholder(__('Time')),

            CheckBox::make('appointment.completed')
                ->sendTrueOrFalse()
                ->title('Completed')
        ];
    }
}
