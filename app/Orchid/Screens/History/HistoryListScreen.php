<?php

namespace App\Orchid\Screens\History;

use App\Models\History;
use App\Orchid\Layouts\History\HistoryListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class HistoryListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'histories' => auth()->user()->histories()->get()
        ];
    }

    public function name(): ?string
    {
        return 'Patient Histories';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Add')
                ->icon('pencil')
                ->route('platform.system.history')
        ];
    }

    public function layout(): iterable
    {
        return [
            HistoryListLayout::class
        ];
    }

    public function remove(History $history)
    {
        $history->delete();
        Toast::info('Removed.');
    }
}
