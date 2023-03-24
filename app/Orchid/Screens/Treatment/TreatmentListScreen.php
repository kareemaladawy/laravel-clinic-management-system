<?php

namespace App\Orchid\Screens\Treatment;

use App\Models\Treatment;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use App\Orchid\Layouts\Treatment\TreatmentListLayout;

class TreatmentListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'treatments' => auth()->user()->treatments()->paginate(10)
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

    public function remove(Treatment $treatment)
    {
        $treatment->delete();
        Toast::info('Removed.');
    }
}
