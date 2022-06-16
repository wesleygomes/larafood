<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategoryFormRequest extends FormRequest
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
        $id = $this->segment(3);

        return [
            'name' => ['required', 'min:3', 'max:255', "unique:categories,name,{$id},id"],
            // 'name' => [
            //     'required',
            //     'min:3',
            //     'max:255',
            //     new UniqueTenant('categories', $id),
            // ],
            'description' => ['required', 'min:3', 'max:10000'],
        ];
    }
}
