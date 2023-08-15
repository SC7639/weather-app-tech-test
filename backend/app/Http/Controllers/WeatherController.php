<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DataProviders\WeatherProvider;
use App\Http\DataTransferObjects\WeatherLatestData;
use App\Http\Requests\LatestWeatherRequest;

class WeatherController extends Controller
{
    public function __construct(protected WeatherProvider $weatherProvider)
    {
    }

    public function latest(LatestWeatherRequest $request): array
    {
        $latestData = WeatherLatestData::fromRequest($request);
        $weatherData = $this->weatherProvider->getLatestForecast($latestData->lat, $latestData->long);
        return ['data' => $weatherData];
    }
}
