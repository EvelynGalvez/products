<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required|numeric|max:999',
            'name'=> 'required|string|max:200',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string|max:200',
            'amount' => 'required|numeric|max:9999',
            'price' => 'required|numeric|max:9999999',
            'branch_id' => 'required|numeric|max:99'

        ];
    }
}
