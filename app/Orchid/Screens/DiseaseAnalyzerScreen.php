<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\ImageTypeForm;
use RealRashid\SweetAlert\Facades\Alert;
use App\Orchid\Layouts\ImageUploadForm;
use Faker\Core\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DiseaseAnalyzerScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __("Eye Disease Analyzer");
    }

    public function permission(): ?iterable
    {
        return [
            'platform.users.diseaseanalyzer'
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Upload'))
                ->icon('check')
                ->method('save'),
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
            Layout::columns([
                ImageUploadForm::class,
                ImageTypeForm::class
            ]),
        ];
    }

    /**
     * @throws \JsonException
     */
    public function save(\Illuminate\Http\Request $request)
    {
        $user = auth()->user();
        $user->attachment()->sync(
            $request->input('image.content', [])
        );
        $imageUrl = $user->attachment()->first()->url ?: null;
        $image = file_get_contents($imageUrl);

        $response = Http::attach('attachment', file_get_contents($imageUrl), 'image.jpg')
            ->post("http://164.90.222.190:80/")
            ->throw(function ($response, $e) {
                return "error: " . $e;
            })->json();

        \Orchid\Support\Facades\Alert::success($response->json($key = 'prediction'));
    }
}
