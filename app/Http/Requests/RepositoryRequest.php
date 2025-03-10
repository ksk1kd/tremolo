<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RepositoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', 'string', 'regex:/^[a-z0-9\-]+$/', 'max:20', Rule::unique('repositories')],
            'name' => ['required', 'string', 'max:50'],
        ];
    }
}
