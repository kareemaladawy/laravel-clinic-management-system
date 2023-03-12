<?php

namespace App\Orchid\Layouts\Patient;

use Carbon\Carbon;
use Orchid\Screen\TD;
use App\Models\Patient;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\DropDown;

class PatientListLayout extends Table
{
    protected $target = 'patients';

    protected function columns(): array
    {
        return [
            TD::make('id', 'Id'),
            TD::make('name', 'Name')
                ->sort()
                ->filter(),
            TD::make(__('Actions'))
                ->render(function (Patient $patient) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.system.patient', $patient->id)
                                ->icon('pencil'),

                            Link::make(__('Show'))
                                ->route('platform.system.patient.show', $patient->id)
                                ->icon('fa.eye')
                    ]);
                }
            ),
        ];
    }
}
