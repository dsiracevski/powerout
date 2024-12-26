<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class   BaseIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'page' => $this->get('page', config('admin.default_first_page', 1)),
            'limit' => $this->get('limit', config('admin.default_page_limit', 5)),
            'filter' => $this->get('filter') ?? [],
        ]);
    }

    /** @return array<string, array<int, string>> */
    public function rules(): array
    {
        return [
            'page' => ['integer', 'required'],
            'limit' => ['integer', 'required'],
            'filter' => ['sometimes',
                /** The value must be a string or array */
                function ($attribute, $value, $fail) {
                    if (!is_string($value) && !is_array($value)) {
                        $fail($attribute . ' must be a string or an array.');
                    }
                },
            ]
        ];
    }
}