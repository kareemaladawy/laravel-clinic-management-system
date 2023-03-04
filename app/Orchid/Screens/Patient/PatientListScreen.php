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
            'patients' => Patient::paginate()
        ];
    }

    public function name(): ?string
    {
        return 'Patients';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.system.patients.create')
        ];
    }

    public function layout(): iterable
    {
        return [
            PatientListLayout::class
        ];
    }
}
