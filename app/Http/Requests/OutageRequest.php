<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'address' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
