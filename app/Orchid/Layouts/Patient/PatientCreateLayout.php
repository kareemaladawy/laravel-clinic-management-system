<?php

namespace App\Orchid\Layouts\Patient;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PatientCreateLayout extends Rows
{
    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('patient.created_by')
                ->value(auth()->id())
                ->type('hidden'),

            Input::make('patient.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('patient.email')
                ->type('email')
                ->max(255)
                ->title(__('Email'))
                ->placeholder(__('Email')),

            Input::make('patient.phone_number',)
                ->type('numeric')
                ->max(13)
                ->title(__('Phone number'))
                ->placeholder(__('Phone number')),

            Select::make('patient.gender',)
                ->options([
                    'male' => __('male'),
                    'female' => __('female')
                ])
                ->title(__('Gender'))
                ->placeholder(__('Gender')),

            Input::make('patient.birthday',)
                ->type('date')
                ->title(__('Birth date'))
                ->placeholder(__('Birth date')),

            Input::make('patient.location',)
                ->type('text')
                ->title(__('Location'))
                ->placeholder(__('Location')),
        ];

    }
}
