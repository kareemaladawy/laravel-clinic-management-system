<?php

namespace App\Orchid\Screens\History;

use App\Models\History;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;
use App\Orchid\Layouts\History\HistoryCreateLayout;

class HistoryEditScreen extends Screen
{
    public $history;

    public function query(History $history): iterable
    {
        return [
            'history' => $history
        ];
    }

    public function name(): ?string
    {
        return $this->history->exists ? 'Edit history' : 'Add history';
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
                ->canSee($this->history->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            HistoryCreateLayout::class
        ];
    }

    public function save(Request $request, History $history)
    {
        if ($history->id != null) {
            $history->update([
                'properties' => $request->history['properties']
            ]);
        } else {
            if (History::where('patient_id', $request->history['patient_id'])->exists()){
                Alert::error('Patient already has a history record.');
                return;
            }
            $history->fill($request->get('history'));
            $history->save();
        }
        Toast::info('Saved.');
        return redirect()->route('platform.system.histories');
    }

    public function remove(History $history)
    {
        $history->delete();
        Toast::info(__('Removed.'));
        return redirect()->route('platform.system.histories');
    }
}
