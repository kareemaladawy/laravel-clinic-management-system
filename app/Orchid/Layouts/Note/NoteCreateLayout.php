<?php

namespace App\Orchid\Layouts\Note;

use App\Models\Patient;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class NoteCreateLayout extends Rows
{
    protected $target = '';

    protected function fields(): iterable
    {
        return [
            Relation::make('note.patient_id')
                ->fromModel(Patient::class, 'name')
                ->title('Choose patient'),

            TextArea::make('note.body')
                ->required()
                ->title(__('Body'))
        ];
    }
}
