<?php

namespace App\Orchid\Layouts\Note;

use App\Models\Note;
use Orchid\Screen\TD;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class NoteListLayout extends Table
{
    protected $target = 'notes';

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id'),
            TD::make('patient', 'Patient')
                ->filter()
                ->render(function (Note $note) {
                    return $note->patient ? Link::make($note->patient->name)
                        ->route('platform.system.patient', $note->patient_id) : '';
                }),
            TD::make('title', 'Title')
                ->filter(),
            TD::make('body', 'Body')
                ->filter()
                ->render(function (Note $note) {
                    return $note->properties ? Str::limit($note->properties, 20, '...') : 'Empty';
                }),
            TD::make(__('Actions'))
                ->render(function (Note $note) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.system.note', $note->id)
                                ->icon('pencil')
                                ->canSee($note->user_id == auth()->id()),

                            Link::make(__('Show'))
                                ->route('platform.system.note.show', $note->id)
                                ->icon('fa.eye'),

                            Button::make(__('Remove'))
                                ->method('remove', [$note->id])
                                ->icon('trash'),
                    ]);
                }
            ),
        ];
    }
}
