<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required','string', 'max:10',
                Rule::unique('products', 'code')->ignore($this->route('product'), 'code')
            ],
            'name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:300'],
            'stock' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'image' => ['string', 'max:255'],
        ];
    }
}
