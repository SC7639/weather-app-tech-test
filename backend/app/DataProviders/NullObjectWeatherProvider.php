<?php

declare(strict_types=1);

namespace App\DataProviders;

use App\DTO\WeatherDTO;
use Carbon\Carbon;

class NullObjectWeatherProvider implements WeatherProvider
{
    public function getLatestForecast(float $lat, float $long): WeatherDTO
    {
        $now = Carbon::now()->toDateString();
        return new WeatherDTO($now, 0, 0);
    }

}
