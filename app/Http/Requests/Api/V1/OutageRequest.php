<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class OutageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'address' => ['required'],
        ];
    }
}
