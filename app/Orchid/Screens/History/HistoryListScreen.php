<?php

namespace App\Orchid\Screens\History;

use App\Models\History;
use App\Orchid\Layouts\History\HistoryListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class HistoryListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'histories' => History::with([
                'patient' => function($query){
                     $query->select('id', 'name');
                }
            ])->paginate(10)
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
                ->route('platform.system.appointment')
        ];
    }

    public function layout(): iterable
    {
        return [
            HistoryListLayout::class
        ];
    }
}
