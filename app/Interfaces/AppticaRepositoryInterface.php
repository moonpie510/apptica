<?php

namespace App\Interfaces;

use App\Models\Application\Application;
use App\Models\Country;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection as SupportCollection;

interface AppticaRepositoryInterface
{
    public function getTopHistory(Application $application, Country $country, ?Carbon $dateFrom = null, ?Carbon $dateTo = null): SupportCollection;
}
