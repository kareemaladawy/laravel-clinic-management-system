<?php

namespace App\Orchid\Screens\Detector;

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

class DetectorScreen extends Screen
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
        return __("Detector");
    }

    public function permission(): ?iterable
    {
        return [
            'platform.system.detector'
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
        // $user = auth()->user();
        // $user->attachment()->sync(
        //     $request->input('image.content', [])
        // );
        // $imageUrl = $user->attachment()->first()->url ?: null;

        // try {
        // $image = file_get_contents($imageUrl);

        // $response = Http::attach('attachment', $image, 'image.jpg')
        //     ->post("http://164.90.222.190:80/")
        //     ->throw(function ($response, $e) {
        //         return "error: " . $e;
        //     })->json();

        // $response = Http::post()
        //     ->post("http://164.90.222.190:80/")
        //     ->throw(function ($response, $e) {
        //         return "error: " . $e;
        //     })->json();

        // dd(openssl_get_cert_locations());

        $client = new \GuzzleHttp\Client(['verify' => 'D:\xampp\php\extras\ssl\cacert.pem']);

        $response = $client->request('POST', 'https://api.writesonic.com/v2/business/content/chatsonic?engine=premium', [
            'body' => '{"enable_google_results":"true","enable_memory":false,"input_text":"what time is it?"}',
            'headers' => [
                'X-API-KEY' => config('services.ChatSonic.API_KEY'),
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);


        \Orchid\Support\Facades\Alert::success(json_decode($response->getBody())->message);
        // } catch (\Exception $e) {
        //     \Orchid\Support\Facades\Alert::warning('an error occurred. please check ML server conncetion.');
        // }
    }
}
