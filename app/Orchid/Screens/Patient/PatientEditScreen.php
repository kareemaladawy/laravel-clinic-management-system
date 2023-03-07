<?php

namespace App\Orchid\Screens\Patient;

use App\Models\Patient;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\Patient\PatientData;
use App\Orchid\Layouts\Patient\PatientCreateLayout;

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
        return $this->patient->exists ? 'Edit patient' : 'Add patient';
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

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->patient->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            PatientCreateLayout::class,
        ];
    }

    public function save(Request $request, Patient $patient)
    {
        $patient->fill($request->get('patient'));
        $patient->save();
        Alert::info('Saved.');
        return redirect()->route('platform.system.patients');
    }
}
