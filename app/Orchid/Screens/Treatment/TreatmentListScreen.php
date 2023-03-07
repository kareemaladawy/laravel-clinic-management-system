<?php

namespace App\Orchid\Screens\Treatment;

use App\Models\Treatment;
use App\Orchid\Layouts\Treatment\TreatmentlistLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class TreatmentListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'treatments' => Treatment::with([
                'patient' => function ($query){
                    $query->select('id','name');
                }
            ])->paginate(10)
        ];
    }

    public function name(): ?string
    {
        return 'Treatments';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Add')
                ->icon('pencil')
                ->route('platform.system.treatment')
        ];
    }

    public function layout(): iterable
    {
        return [
            TreatmentListLayout::class
        ];
    }
}
