<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ImageTypeForm extends Rows
{
    protected $target = '';

    protected function fields(): iterable
    {
        return [
            Select::make('image.type')
                ->options([
                    'Fundus' => 'Fundus',
                    'OCT' => 'OCT'
                ])
                ->required()
                ->title(__('Choose image type (Fundus - OCT)')),

            TextArea::make('image.notes')
                ->title(__('Notes')),
        ];
    }
}
