<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileHistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'entries_amount' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
