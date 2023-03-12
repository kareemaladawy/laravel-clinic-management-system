<?php

namespace App\Orchid\Screens\Treatment;

use Orchid\Screen\Sight;
use App\Models\Treatment;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;

class TreatmentShowScreen extends Screen
{
    public $treatment;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Treatment $treatment): iterable
    {
        return [
            'treatment' => $treatment
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Treatment';
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
                ->route('platform.system.treatments'),
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
            Layout::legend('treatment',[
                Sight::make('id',__('ID')),
                Sight::make('patient_id',__('Patient ID')),
                Sight::make('patient',__('Patient Name'))
                    ->render(function(Treatment $treatment){
                        return str_replace(array('["','"]'),'',$treatment->patient()->pluck('name'));
                    }),
                Sight::make('body', __('Body')),
                Sight::make('created_at',__('Created At'))
                    ->render(
                        fn(Treatment $treatment)=>$treatment->created_at . '<br>' . $treatment->created_at->diffForHumans()
                    ),
            ]),
        ];
    }
}
