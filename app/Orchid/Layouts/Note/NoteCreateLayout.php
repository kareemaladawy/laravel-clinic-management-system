<?php

namespace App\Orchid\Layouts\Note;

use App\Models\Patient;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class NoteCreateLayout extends Rows
{
    protected $target = '';

    protected function fields(): iterable
    {
        return [
            Select::make('note.patient_id')
                ->fromQuery(Patient::where('created_by', auth()->id()), 'name')
                ->empty()
                ->title('Choose patient'),

            Input::make('note.title')
                ->required()
                ->title(__('Title')),

            TextArea::make('note.body')
                ->required()
                ->title(__('Body'))
        ];
    }
}
