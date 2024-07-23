<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'cec_number' => ['required', 'integer'],
            'properties' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
