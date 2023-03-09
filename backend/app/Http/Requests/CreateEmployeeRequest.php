<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class CreateEmployeeRequest extends Request
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
            'name' => 'required|string',
            'password' => 'required|string',
            'age' => 'required|integer',
            'role_id' => 'required|integer'
        ];
    }
}
