<?php

namespace App\Orchid\Screens\Patient;

use App\Models\Patient;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class PatientEditScreen extends Screen
{

    public $patient;

    public function query(Patient $patient): iterable
    {
        return [
            'patient' => $patient
        ];
    }

    public function name(): ?string
    {
        return 'Edit patient';
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
            Button::make('Update')
                ->icon('note')
                ->method('update')
                ->canSee($this->patient->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->patient->exists),
        ];
    }

    public function layout(): iterable
    {
        return [];
    }
}
