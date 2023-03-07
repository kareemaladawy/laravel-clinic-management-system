<?php

namespace App\Orchid\Screens\Note;

use App\Models\Note;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use App\Orchid\Layouts\Note\NoteCreateLayout;

class NoteEditScreen extends Screen
{
    public $note;

    public function query(Note $note): iterable
    {
        return [
            'note' => $note
        ];
    }

    public function name(): ?string
    {
        return $this->note->exists ? 'Edit note' : 'Add note';
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Save')
                ->icon('note')
                ->method('save'),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->note->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            NoteCreateLayout::class
        ];
    }

    public function save(Request $request, Note $note)
    {
        $note->fill($request->get('note'));
        $request->user()->notes()->save($note);
        Toast::info('Saved.');
        return redirect()->route('platform.system.notes');
    }

    public function remove(Note $note)
    {
        $note->delete();
        Toast::info(__('Removed.'));
        return redirect()->route('platform.system.notes');
    }
}
