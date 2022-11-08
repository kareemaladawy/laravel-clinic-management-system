<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ImageTypeForm extends Rows
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = '';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function fields(): iterable
    {
        return [
            Select::make('image.type')
                ->options([
                    'fundus'   => 'Fundus',
                    'regular' => 'Regular',
                ])
                ->empty('Select uploaded image type (Fundus/Regular)')
                ->title(__('Image type')),

            TextArea::make('image.notes')
                ->title(__('Notes')),
        ];
    }
}
