<?php

declare(strict_types=1);

namespace App\Providers;

use App\DataProviders\BlueSkyWeatherProvider;
use App\DataProviders\NullObjectWeatherProvider;
use App\DataProviders\WeatherProvider;
use Illuminate\Support\ServiceProvider;

class ExternalDataProvidersProvider extends ServiceProvider
{
    /**
     * Register application services
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WeatherProvider::class, function ($app) {
            return match(config('external-apis.weatherProvider')) {
                'blue-sky' => new BlueSkyWeatherProvider(),
                default => new NullObjectWeatherProvider(),
            };
        });
    }
}
