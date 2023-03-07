<?php

namespace App\Orchid\Screens\Detection;

use App\Models\Detection;
use Orchid\Screen\Screen;
use App\Orchid\Layouts\Detection\DetectionListLayout;

class DetectionListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'detections' => Detection::paginate(10)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Detections';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            DetectionListLayout::class
        ];
    }
}
