<?php

namespace App\Orchid\Screens\Patient;

use App\Models\Patient;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class PatientCreateScreen extends Screen
{

    public function query(): iterable
    {
        return [];
    }

    public function name(): ?string
    {
        return 'Create patient';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.system.patients',
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Button::make('Save')
                ->icon('note')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [];
    }
}
