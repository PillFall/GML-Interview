<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'not_regex:/[0-9]+/',
                'min:5',
                'max:100',
            ],
            'surname' => [
                'required',
                'string',
                'not_regex:/[0-9]+/',
                'max:100',
            ],
            'identifier' => [
                'required',
                'string',
                Rule::unique('users', 'identifier')->ignore($this->user['id']),
            ],
            'category' => [
                'required',
                'integer',
                'exists:categories,id',
            ],
            'mobile' => [
                'required',
                'string',
                'size:10',
                'not_in:/[a-zA-Z ]+/',
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')->ignore($this->user['id']),
                'max:150',
            ],
            'country' => [
                'required',
                'size:3',
                Rule::in(Cache::remember('countries', 7200, function () {
                    return Http::acceptJson()
                        ->get('https://restcountries.com/v3.1/subregion/South America?fields=cca3,translations')
                        ->collect();
                })->pluck('cca3')),
            ],
            'address' => [
                'required',
                'string',
                'max:180',
            ],
        ];
    }
}
