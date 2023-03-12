<?php

namespace App\Orchid\Screens\Patient;

use App\Models\Patient;
use App\Orchid\Layouts\Patient\PatientListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class PatientListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'patients' => auth()->user()->patients()->paginate(10)
        ];
    }

    public function name(): ?string
    {
        return 'Patients';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Add')
                ->icon('pencil')
                ->route('platform.system.patient')
        ];
    }

    public function layout(): iterable
    {
        return [
            PatientListLayout::class
        ];
    }
}
