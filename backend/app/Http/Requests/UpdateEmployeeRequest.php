<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !!auth()->user();
    }

    public function validationData(): array
    {
        $data = $this->all();
        $data['id'] = $this->route('id');
        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'name' => 'sometimes|string',
            'age' => 'sometimes|integer',
            'role_id' => 'sometimes|integer'
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
