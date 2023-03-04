<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ImageUploadForm extends Rows
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
            Select::make('image.patient')
                ->options([
                    '1' => 'What ha?'
                ])
                ->empty('Select patient')
                ->title('Patient'),

            Picture::make('image.content')
                ->title(__('Image'))
                ->targetid()
        ];
    }
}
