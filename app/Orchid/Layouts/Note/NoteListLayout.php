<?php

namespace App\Orchid\Layouts\Note;

use App\Models\Note;
use Orchid\Screen\TD;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class NoteListLayout extends Table
{
    protected $target = 'notes';

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id')
                ->render(function (Note $note) {
                    return Link::make($note->id)
                        ->route('platform.system.history', $note);
                }),
            TD::make('patient', 'Patient')
                ->filter()
                ->render(function (Note $note) {
                    return $note->patient ? Link::make($note->patient->name)
                        ->route('platform.system.patient', $note->patient_id) : '"not associated with a patient"';
                }),
            TD::make('body', 'Body')
                ->filter()
                ->render(function (Note $note) {
                    return Link::make(Str::limit($note->body, 20, '...'))
                        ->route('platform.system.note', $note);
                }),
            TD::make('created_at', 'Created at')
                ->sort()->filter()
                ->render(function (Note $note) {
                    return Carbon::parse($note->created_at)->format('g:i A');
                }),
            TD::make('created_at', 'Created at')
                ->sort()->filter()
                ->render(function (Note $note) {
                    return Carbon::parse($note->created_at)->format('g:i A');
                }),
        ];
    }
}
