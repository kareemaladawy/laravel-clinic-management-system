<?php

namespace App\Orchid\Screens\Detector;

use App\Models\Detection;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Facades\Http;
use App\Orchid\Layouts\ImageTypeForm;
use App\Orchid\Layouts\ImageUploadForm;

class DetectorScreen extends Screen
{
    public function query(): iterable
    {
        return [];
    }

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

    public function commandBar(): iterable
    {
        return [
            Button::make(__('Detect'))
                ->icon('check')
                ->method('detect'),
        ];
    }

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
    public function detect(Request $request)
    {
        dd($request->patient);
        $user = $request->user();

        $user->attachment()->sync(
            $request->input('image.content', [])
        );

        $imageUrl = $user->attachment()->first()->url ?: null;

        try {
            $image = file_get_contents($imageUrl);
            $response = Http::attach('attachment', $image, 'image.jpg')
                ->post("http://164.90.222.190:80/")
                ->throw(function ($response, $e) {
                    return "error: " . $e;
                })->json();

            $responseBody = json_decode($response->getBody());
            $this->saveDetection($responseBody);
            Alert::success($responseBody->detection);


            //chat
            // dd(openssl_get_cert_locations());
            // $client = new \GuzzleHttp\Client(['verify' => 'D:\xampp\php\extras\ssl\cacert.pem']);
            // $response = $client->request('POST', 'https://api.writesonic.com/v2/business/content/chatsonic?engine=premium', [
            //     'body' => '{"enable_google_results":"true","enable_memory":false,"input_text":"what time is it?"}',
            //     'headers' => [
            //         'X-API-KEY' => config('services.ChatSonic.API_KEY'),
            //         'accept' => 'application/json',
            //         'content-type' => 'application/json',
            //     ],
            // ]);
            // Alert::success(json_decode($response->getBody())->message);
        } catch (\Exception $e) {
            Alert::error('An error occurred. Please check your connection with ML server.');
        }
    }

    protected function saveDetection($responseBody)
    {
        $detection = new Detection;
        $detection->disease = $responseBody->disease;
        $detection->state = $responseBody->state;
        $detection->type = $responseBody->type;
        $detection->save();
    }
}
