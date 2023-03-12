<?php

namespace App\Orchid\Layouts\Treatment;

use Orchid\Screen\TD;
use App\Models\Treatment;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;

class TreatmentListLayout extends Table
{
    protected $target = 'treatments';

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id'),
            TD::make('patient_id', 'Patient')
                ->filter()
                ->render(function (Treatment $treatment) {
                    return Link::make($treatment->patient->name)
                        ->route('platform.system.patient', $treatment->patient_id);
                }),
            TD::make('body', 'Body')
                ->filter(),
            TD::make(__('Actions'))
                ->render(function (Treatment $treatment) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.system.treatment', $treatment->id)
                                ->icon('pencil')
                                ->canSee($treatment->user_id == auth()->id()),

                            Link::make(__('Show'))
                                ->route('platform.system.treatment.show', $treatment->id)
                                ->icon('fa.eye'),

                            Button::make(__('Remove'))
                                ->method('remove', [$treatment->id])
                                ->icon('trash'),
                    ]);
                }
            ),
        ];
    }
}
