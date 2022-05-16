<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePlanFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $roles = [
            'name' => ['required', 'min:5', 'string', 'max:255','unique:plans'],
            'price' => ['required'],
            'description' => ['required', 'max:255']
        ];

        return $roles;
    }
}
