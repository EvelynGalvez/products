<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'code' => 'sometimes|numeric|max:999',
            'name'=> 'sometimes|string|max:200',
            'category' => 'sometimes|string|max:100',
            'description' => 'nullable|sometimes|string|max:200',
            'amount' => 'sometimes|numeric|max:9999',
            'price' => 'sometimes|numeric|max:9999999',
            'branch_id' => 'sometimes|numeric|max:99'
        ];
    }
}
