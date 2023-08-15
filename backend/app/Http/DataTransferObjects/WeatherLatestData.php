<?php

declare(strict_types=1);

namespace App\Http\DataTransferObjects;

use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class WeatherLatestData extends Data
{
    public function __construct(
        public float $lat,
        public float $long
    ) {
    }

    public static function fromRequest(Request $request): static
    {
        return new self(
            (float) $request->input('lat'),
            (float) $request->input('long')
        );
    }
}
