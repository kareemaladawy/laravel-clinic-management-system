<?php

namespace App\Orchid\Screens\Patient;

use App\Models\Patient;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;
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
        $request->user()->patients()->save($patient);
        Toast::info('Saved.');
        return redirect()->route('platform.system.patients');
    }

    public function remove(Patient $patient)
    {
        $patient->history()->delete();
        $patient->delete();
        Toast::info(__('Removed.'));
        return redirect()->route('platform.system.patients');
    }
}
