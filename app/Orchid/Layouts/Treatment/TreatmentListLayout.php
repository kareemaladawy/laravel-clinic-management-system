<?php

namespace App\Orchid\Layouts\Treatment;

use Orchid\Screen\TD;
use App\Models\Treatment;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class TreatmentListLayout extends Table
{
    protected $target = 'treatments';

    protected function columns(): iterable
    {
        return [
            TD::make('id', 'Id')
                ->render(function (Treatment $treatment) {
                    return Link::make($treatment->id)
                        ->route('platform.system.treatment', $treatment);
                }),
            TD::make('patient_id', 'Patient')
                ->render(function (Treatment $treatment) {
                    return Link::make($treatment->patient->name)
                        ->route('platform.system.patient', $treatment->patient_id);
                }),
            TD::make('body', 'Prescription')
                ->render(function (Treatment $treatment) {
                    return Link::make(Str::limit($treatment->body, 20, '...'))
                        ->route('platform.system.treatment', $treatment);
                }),
            TD::make('created_at', 'Created at')
                ->sort()->filter()
                ->render(function (Treatment $treatment) {
                    return Carbon::parse($treatment->created_at)->format('g:i A');
                }),
            TD::make('updated_at', 'Last edit at')
                ->sort()->filter()
                ->render(function (Treatment $treatment) {
                    return Carbon::parse($treatment->updated_at)->format('g:i A');
                }),
        ];
    }
}
