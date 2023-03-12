<?php

namespace App\Orchid\Layouts\Treatment;

use App\Models\Patient;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Relation;

class TreatmentCreateLayout extends Rows
{
    protected $target = 'treatments';

    protected function fields(): iterable
    {
        return [
            Input::make('treatment.user_id')
                ->value(auth()->user()->id)
                ->type('hidden'),

            Relation::make('treatment.patient_id')
                ->fromModel(Patient::class, 'name')
                ->required()
                ->title('Choose patient'),

            Input::make('treatment.body')
                ->type('text')
                ->required()
                ->title(__('Body')),
        ];
    }
}
