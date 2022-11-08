<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Orchid\Layouts\Examples\ChartBarExample;
use App\Orchid\Layouts\Examples\ChartLineExample;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
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
                'patients' => ['value' => number_format(83), 'diff' => 2.08],
                'analysis-pending' => ['value' => number_format(5)],
                'results' => ['value' => number_format(78), 'diff' => 15.6],
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
        return 'Hello, ' . auth()->user()->name;
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
           Link::make('Launch analyzer')
                ->icon('full-screen')
                ->route('platform.diseaseanalyzer'),
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
                'Patients Today' => 'metrics.patients',
                'Pending Analysis' => 'metrics.analysis-pending',
                'Successful Results' => 'metrics.results',
            ]),

            Layout::columns([
                ChartLineExample::make('charts', 'Results')
                    ->description('Showing results over the 30 last days'),
            ]),
        ];
    }
}
