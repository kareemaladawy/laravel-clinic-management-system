<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\Examples\ChartLineExample;

class PlatformScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'charts'  => [
                [
                    'name'   => 'Confirmed',
                    'values' => [70, 70, 80, 90, 100, 100, 100],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name'   => 'Labeled',
                    'values' => [25, 50, 60, 70, 80, 90, 100],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name'   => 'Successful',
                    'values' => [15, 20, 25, 30, 35, 40, 50],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
                [
                    'name'   => 'Pending Approval',
                    'values' => [10, 10, 10, 10, 50, 20, 10],
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                ],
            ],

            'metrics' => [
                'patients' => ['value' => auth()->user()->patients()->count()],
                'detections' => ['value' => auth()->user()->detections()->count()],
                'appointments' => ['value' => auth()->user()->appointments()->count()],
                'treatments' => ['value' => auth()->user()->treatments()->count()],
                'notes' => ['value' => auth()->user()->notes()->count()],
            ],
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Hello, ' . auth()->user()->firstName;
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Welcome to your dashboard.';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
           Link::make('Launch detector')
                ->icon('frame')
                ->route('platform.system.detector'),

            Link::make('View patients')
                ->icon('friends')
                ->route('platform.system.patients'),

            Link::make('View notes')
                ->icon('note')
                ->route('platform.system.notes'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::metrics([
                'Pending Appointments' => 'metrics.appointments',
                'Patients' => 'metrics.patients',
                'Detections' => 'metrics.detections',
                'Treatments' => 'metrics.treatments',
                'Notes' => 'metrics.notes',
            ]),

            Layout::columns([
                ChartLineExample::make('charts', 'Results')
                    ->description('Showing results over the 30 last days'),
            ]),
        ];
    }
}
