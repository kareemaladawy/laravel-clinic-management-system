<?php

namespace App\Orchid\Layouts\Patient;

use App\Models\History;
use App\Models\Patient;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PatientData extends Rows
{
    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function fields(): iterable
    {
        return [
            TextArea::make('patient->history->properties')
                ->title('History'),
        ];
    }
}
