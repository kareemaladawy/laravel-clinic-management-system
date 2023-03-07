<?php

namespace App\Orchid\Layouts\Appointment;

use App\Models\Patient;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;

class AppointmentCreateLayout extends Rows
{
    protected $target = '';

    protected function fields(): iterable
    {
        return [
            Relation::make('appointment.patient_id')
                ->fromModel(Patient::class, 'name')
                ->required()
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
