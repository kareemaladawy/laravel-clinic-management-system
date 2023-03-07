<?php

namespace App\Orchid\Layouts\Patient;

use App\Models\Patient;
use Carbon\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PatientListLayout extends Table
{
    protected $target = 'patients';

    protected function columns(): array
    {
        return [
            TD::make('id', 'Id'),
            TD::make('name', 'Name')
                ->render(function (Patient $patient) {
                    return Link::make($patient->name)
                        ->route('platform.system.patient', $patient);
                }),
            TD::make('email', 'Email'),
            TD::make('phone_number', 'Phone number'),
            TD::make('created_at', 'Created at')
                ->sort()->filter()
                ->render(function (Patient $patient) {
                    return Carbon::parse($patient->created_at);
                }),
            TD::make('updated_at', 'Last edit at')->sort()->filter()
                ->render(function (Patient $patient) {
                    return Carbon::parse($patient->created_at);
                }),
        ];
    }
}
