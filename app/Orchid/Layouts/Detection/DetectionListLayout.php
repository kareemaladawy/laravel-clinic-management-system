<?php

namespace App\Orchid\Layouts\Detection;

use Carbon\Carbon;
use Orchid\Screen\TD;
use App\Models\Detection;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class DetectionListLayout extends Table
{
    protected $target = 'detections';

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id')
                ->render(function (Detection $detection) {
                    return Link::make($detection->id)
                        ->route('platform.system.detection', $detection);
                }),
            TD::make('patient_id', 'Patient Id')
                ->render(function (Detection $detection) {
                    return Link::make($detection->patient_id)
                        ->route('platform.system.patient', $detection->patient_id);
                }),
            TD::make('disease', 'Disease'),
            TD::make('created_at', 'Date of detection')
                ->sort()->filter()
                ->render(function (Detection $detection) {
                    return Carbon::parse($detection->created_at)->format('g:i A');
                }),
            TD::make(__('Actions'))
                ->render(function (Detection $detection) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.system.detection', $detection->id)
                                ->icon('pencil')
                                ->canSee($detection->user_id == auth()->id()),
                    ]);
                }
            ),
        ];
    }
}
