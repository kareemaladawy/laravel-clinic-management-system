<?php

namespace App\Orchid\Screens\Note;

use App\Models\Note;
use Orchid\Screen\Sight;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;

class NoteShowScreen extends Screen
{
    public $note;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Note $note): iterable
    {
        return [
            'note' => $note
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Note';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Return')
                ->icon('action-undo')
                ->route('platform.system.notes'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::legend('note',[
                Sight::make('id',__('ID')),
                Sight::make('patient_id',__('Patient ID')),
                Sight::make('patient',__('Patient Name'))
                    ->render(function(Note $note){
                        return str_replace(array('["','"]'),'',$note->patient()->pluck('name'));
                    }),
                Sight::make('body',__('Body'))
                    ->render(fn(Note $note)=>$note->body ? $note->body : 'Empty'),
                Sight::make('created_at',__('Created At'))
                    ->render(
                        fn(Note $note)=>$note->created_at . '<br>' . $note->created_at->diffForHumans()
                    ),
            ]),
        ];
    }
}
