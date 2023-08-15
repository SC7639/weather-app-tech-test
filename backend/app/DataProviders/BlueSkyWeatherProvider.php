<?php

declare(strict_types=1);

namespace App\DataProviders;

use App\DataTransferObjects\WeatherData;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Cast\Object_;

class BlueSkyWeatherProvider implements WeatherProvider
{
    public function getLatestForecast(float $lat, float $long): Collection
    {
        $searchParams = Arr::query([
            'lat' => $lat,
            'lon' => $long,
        ]);

        return $this->doRequest(
            "/forecasts/latest?$searchParams"
        );
    }

    private function doRequest(string $path): Collection
    {
        $now = Carbon::now()->toDateString();
        $baseUrl = config('external-apis.blue-sky.base_url');
        $path = ltrim($path, '/');


        try {
            $response = Http::get("$baseUrl/$path");
            if (!$response->successful()) {
                Log::info("Response failed with status {$response->status()} and {$response->body()}");
                return Collection::make();
            }

            $data = $response->json();
            return collect($data)->map(fn ($datum) => new WeatherData(
                $datum['forecast_moment'],
                $datum['forecast_distance'],
                $datum['apparent_temperature_at_2m'],
            ));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return Collection::make();
        }
    }
}
