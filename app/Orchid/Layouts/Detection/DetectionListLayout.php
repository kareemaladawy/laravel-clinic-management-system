<?php

namespace App\Orchid\Layouts\Detection;

use Carbon\Carbon;
use Orchid\Screen\TD;
use App\Models\Detection;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;

class DetectionListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'detections';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
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
            TD::make('state', 'State'),
            TD::make('type', 'Type'),
            TD::make('comment', 'Comment'),
            TD::make('created_at', 'Created at')
                ->sort()->filter()
                ->render(function (Detection $detection) {
                    return Carbon::parse($detection->created_at);
                }),
            TD::make('updated_at', 'Last edit at')->sort()->filter()
                ->render(function (Detection $detection) {
                    return Carbon::parse($detection->created_at);
                }),
        ];
    }
}
