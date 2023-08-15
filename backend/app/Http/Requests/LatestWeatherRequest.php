<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LatestWeatherRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lat' => ['required', 'numeric','decimal:1,10'],
            'long' => ['required', 'numeric', 'decimal:1,10'],
        ];
    }
}
