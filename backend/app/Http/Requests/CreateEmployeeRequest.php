<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class CreateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !!auth()->user();
    }

    public function validated($key = null, $default = null): mixed
    {
        // append manager_id to the request before validation
        $data = $this->all();

        $data['password'] = Hash::make($data['password']);
        return array_merge($data, [ 'manager_id' => auth()->user()->id ]);
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
            'role_id' => 'required|integer',
        ];
    }
}
