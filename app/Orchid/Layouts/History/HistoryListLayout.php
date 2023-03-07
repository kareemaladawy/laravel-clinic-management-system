<?php

namespace App\Orchid\Layouts\History;

use Carbon\Carbon;
use Orchid\Screen\TD;
use App\Models\History;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class HistoryListLayout extends Table
{
    protected $target = 'histories';

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id')
                ->render(function (History $history) {
                    return Link::make($history->id)
                        ->route('platform.system.history', $history);
                }),
            TD::make('patient', 'Patient')
                ->filter()
                ->render(function (History $history) {
                    return Link::make($history->patient->name)
                        ->route('platform.system.patient', $history->patient_id);
                }),
            TD::make('properties', 'Properties')
                ->filter()
                ->render(function (History $history) {
                    return Link::make(Str::limit($history->properties, 20, '...'))
                        ->route('platform.system.history', $history);
                }),
            TD::make('created_at', 'Created at')
                ->sort()->filter()
                ->render(function (History $history) {
                    return Carbon::parse($history->created_at)->format('g:i A');
                }),
            TD::make('updated_at', 'Last edit at')
                ->sort()->filter()
                ->render(function (History $history) {
                    return Carbon::parse($history->updated_at)->format('g:i A');
                }),
        ];
    }
}
