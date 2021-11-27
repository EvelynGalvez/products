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
            'code' => 'required|numeric',
            'name'=> 'required|string|max:200',
            'category' => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
            'branch_id' => 'required|numeric',
            'branch_name' => 'required|string|max:200'
        ];
    }
}
