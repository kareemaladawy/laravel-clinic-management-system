<?php

namespace App\Orchid\Layouts\History;

use App\Models\History;
use App\Models\Patient;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class HistoryCreateLayout extends Rows
{
    protected $target = '';

    protected function fields(): iterable
    {
        return [
            Relation::make('history.patient_id')
                ->fromModel(Patient::class, 'name')
                ->required()
                ->title('Choose patient'),

            TextArea::make('history.properties')
                ->title(__('Properties'))
                ->placeholder(__('Properties')),
        ];
    }
}
