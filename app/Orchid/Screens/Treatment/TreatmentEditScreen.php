<?php

namespace App\Orchid\Screens\Treatment;

use App\Models\Treatment;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use App\Orchid\Layouts\Treatment\TreatmentCreateLayout;

class TreatmentEditScreen extends Screen
{
    public $treatment;

    public function query(Treatment $treatment): iterable
    {
        return [
            'treatment' => $treatment
        ];
    }

    public function name(): ?string
    {
        return $this->treatment->exists ? 'Edit treatment' : 'Add treatment';
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
                ->canSee($this->treatment->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            TreatmentCreateLayout::class
        ];
    }

    public function save(Request $request, Treatment $treatment)
    {
        $treatment->fill($request->get('treatment'));
        $request->user()->treatments()->save($treatment);
        Toast::info('Saved.');
        return redirect()->route('platform.system.treatments');
    }

    public function remove(Treatment $treatment)
    {
        $treatment->delete();
        Toast::info(__('Removed.'));
        return redirect()->route('platform.system.treatments');
    }
}
