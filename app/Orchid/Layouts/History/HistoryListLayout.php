<?php

namespace App\Orchid\Layouts\History;

use Carbon\Carbon;
use Orchid\Screen\TD;
use App\Models\History;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class HistoryListLayout extends Table
{
    protected $target = 'histories';

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id'),
            TD::make('patient', 'Patient')
                ->filter()
                ->render(function (History $history) {
                    return Link::make($history->patient->name)
                        ->route('platform.system.patient', $history->patient_id);
                }),
            TD::make('properties', 'Properties')
                ->filter()
                ->render(function (History $history) {
                    return $history->properties ? Str::limit($history->properties, 20, '...') : 'Empty';
                }),
            TD::make(__('Actions'))
                ->render(function (History $history) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.system.history', $history->id)
                                ->icon('pencil'),

                            Link::make(__('Show'))
                                ->route('platform.system.history.show', $history->id)
                                ->icon('fa.eye'),

                            Button::make(__('Remove'))
                                ->method('remove', [$history->id])
                                ->icon('trash'),
                    ]);
                }
            ),
        ];
    }
}
