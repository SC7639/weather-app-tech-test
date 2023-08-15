<?php

declare(strict_types=1);

namespace App\DataProviders;

use Illuminate\Support\Collection;

interface WeatherProvider
{
    public function getLatestForecast(float $lat, float $long): Collection;
}
