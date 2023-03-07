<?php

namespace App\Orchid\Screens\Appointment;

use Orchid\Screen\Screen;
use App\Models\Appointment;
use App\Orchid\Layouts\Appointment\AppointmentCreateLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;

class AppointmentEditScreen extends Screen
{
    public $appointment;

    public function query(Appointment $appointment): iterable
    {
        return [
            'appointment' => $appointment
        ];
    }

    public function name(): ?string
    {
        return $this->appointment->exists ? 'Edit appointment' : 'Add appointment';
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
                ->canSee($this->appointment->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            AppointmentCreateLayout::class
        ];
    }

    public function save(Request $request, Appointment $appointment)
    {
        $appointment->fill($request->get('appointment'));
        $request->user()->appointments()->save($appointment);
        Toast::info('Saved.');
        return redirect()->route('platform.system.appointments');
    }

    public function remove(Appointment $appointment)
    {
        $appointment->delete();
        Toast::info(__('Removed.'));
        return redirect()->route('platform.system.appointments');
    }
}
