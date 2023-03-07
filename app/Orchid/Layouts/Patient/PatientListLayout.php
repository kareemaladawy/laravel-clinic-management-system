<?php

namespace App\Orchid\Layouts\Patient;

use App\Models\Patient;
use Carbon\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PatientListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'patients';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'Id')
                ->render(function (Patient $patient) {
                    return Link::make($patient->id)
                        ->route('platform.system.patient', $patient);
                }),
            TD::make('name', 'Name'),
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
