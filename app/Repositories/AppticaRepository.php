<?php

namespace App\Repositories;

use App\Interfaces\AppticaRepositoryInterface;
use App\Models\Application\Application;
use App\Models\Country;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Http;

class AppticaRepository implements AppticaRepositoryInterface
{
    private string $baseUrl;
    private string $token;

    public function __construct()
    {
        $this->baseUrl = config('services.apptica.url');
        $this->token = config('services.apptica.token');
    }

    public function getTopHistory(Application $application, Country $country, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): SupportCollection
    {
        $query = [
            'B4NKGg' => $this->token
        ];

        if ($dateFrom) {
            $query['date_from'] = $dateFrom->format('Y-m-d');
        }

        if ($dateTo) {
            $query['date_to'] = $dateTo->format('Y-m-d');
        }

        $response = Http::get("$this->baseUrl/package/top_history/$application->external_id/$country->external_id", $query);

        if ($response->failed()) {
            dd($response->json());
        }

        return collect($response->json('data'));
    }
}
