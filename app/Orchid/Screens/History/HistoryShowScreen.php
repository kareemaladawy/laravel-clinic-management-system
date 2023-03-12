<?php

namespace App\Orchid\Screens\History;

use App\Models\History;
use Orchid\Screen\Sight;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;

class HistoryShowScreen extends Screen
{
    public $history;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(History $history): iterable
    {
        return [
            'history' => $history
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'History';
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
                ->route('platform.system.histories'),
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
            Layout::legend('history',[
                Sight::make('id',__('ID')),
                Sight::make('patient_id',__('Patient ID')),
                Sight::make('patient',__('Patient Name'))
                    ->render(function(History $history){
                        return str_replace(array('["','"]'),'',$history->patient()->pluck('name'));
                    }),
                Sight::make('properties',__('Properties'))
                    ->render(fn(History $history)=>$history->properties ? $history->properties : 'Empty'),
                Sight::make('created_at',__('Created at'))
                    ->render(
                        fn(History $history)=>$history->created_at . '<br>' . $history->created_at->diffForHumans()
                    ),
            ]),
        ];
    }
}
