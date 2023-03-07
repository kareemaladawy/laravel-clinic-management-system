<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\TD;
use App\Models\Patient;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;

class ImageUploadForm extends Rows
{
    protected $target = '';

    protected function fields(): iterable
    {
        return [
            Relation::make('patient')
                ->fromModel(Patient::class, 'name')
                ->required()
                ->title('Choose patient'),

            Picture::make('image.content')
                ->title(__('Upload image'))
                ->required()
                ->targetid()
        ];
    }
}
