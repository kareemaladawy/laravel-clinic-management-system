<?php

namespace App\Orchid\Screens\Appointment;

use Orchid\Screen\Screen;
use App\Models\Appointment;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Appointment\AppointmentListLayout;

class AppointmentListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'appointments' => Appointment::paginate(10)
        ];
    }

    public function name(): ?string
    {
        return 'Appointments';
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Add')
                ->icon('pencil')
                ->route('platform.system.appointment')
        ];
    }

    public function layout(): iterable
    {
        return [
            AppointmentListLayout::class
        ];
    }
}
