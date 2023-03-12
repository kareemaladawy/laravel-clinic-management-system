<?php

namespace App\Orchid\Screens\Patient;

use App\Models\Patient;
use Orchid\Screen\Sight;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;

class PatientShowScreen extends Screen
{
    public $patient;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Patient $patient): iterable
    {
        return [
            'patient' => $patient
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Patient';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Return')
                ->icon('action-undo')
                ->route('platform.system.patients'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::legend('patient',[
                Sight::make('id',__('ID')),
                Sight::make('name',__('Name')),
                Sight::make('history',__('History'))
                    ->render(
                        function (Patient $patient){
                            return str_replace(array('["','"]'),'',$patient->history()->pluck('properties'));
                        }
                    ),
                Sight::make('created_at',__('Created'))
                    ->render(
                        fn(Patient $patient)=>$patient->created_at . '<br>' . $patient->created_at->diffForHumans()
                    ),
            ]),
        ];
    }
}
