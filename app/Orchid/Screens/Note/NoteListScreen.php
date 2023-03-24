<?php

namespace App\Orchid\Screens\Note;

use App\Models\Note;
use App\Orchid\Layouts\Note\NoteListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class NoteListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'notes' => auth()->user()->notes()->paginate(10)
        ];
    }

    public function name(): ?string
    {
        return 'Notes';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Add')
                ->icon('pencil')
                ->route('platform.system.note')
        ];
    }

    public function layout(): iterable
    {
        return [
            NoteListLayout::class
        ];
    }
}
