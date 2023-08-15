<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Support\Wrapping\WrapExecutionType;

class WeatherData extends DataCollection
{
    public function __construct(public string $timestamp, public int $hoursAhead, public float $temperature)
    {
    }

    private function convertTemperatureToCelsius(): float
    {
        return (float) number_format($this->temperature - 273.15, 2);
    }

    public function transform(bool $transformValues = true, WrapExecutionType $wrapExecutionType = WrapExecutionType::Disabled, bool $mapPropertyNames = true): array
    {
        return [
            'timestamp' => (string) $this->timestamp,
            'hoursAhead' => (int) $this->hoursAhead,
            'temperature' => (float) $this->convertTemperatureToCelsius(),
        ];
    }
}
