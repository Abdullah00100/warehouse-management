<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            "name" => "required|min:1|max:256",
            'image_path' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            "product_code" => "required|unique:products",
            "purchasing_price" => "required|min:1|max:256",
            "seling_price" => "required|min:1|max:256",
            "department_id" => "required|exists:departments,id",
            "note" => "min:1|max:256"
        ];
    }
}
