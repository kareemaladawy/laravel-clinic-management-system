<?php

namespace App\Orchid\Layouts\History;

use App\Models\Patient;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class HistoryCreateLayout extends Rows
{
    protected $target = '';

    protected function fields(): iterable
    {
        return [
            Select::make('history.patient_id')
                ->fromQuery(Patient::where('created_by', auth()->id()), 'name')
                ->required()
                ->empty()
                ->title('Choose patient'),

            TextArea::make('history.properties')
                ->title(__('Properties'))
        ];
    }
}
