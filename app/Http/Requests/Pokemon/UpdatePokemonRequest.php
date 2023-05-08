<?php

namespace App\Http\Requests\Pokemon;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePokemonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('pokemon', 'name')->ignore($this->pokemon->uuid, 'uuid'),
            ],
            'sprite_url' => [
                'required',
                'string',
                'url',
            ],
            'weight' => [
                'required',
                'integer',
                'max:32767',
            ],
            'height' => [
                'required',
                'integer',
                'max:32767',
            ],
            'types' => [
                'required',
                'array',
            ],
            'types.*' => [
                'required',
                'string',
                'uuid',
                'exists:types,uuid'
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'weight' => $this->integer('weight'),
            'height' => $this->integer('height'),
        ]);
    }
}
