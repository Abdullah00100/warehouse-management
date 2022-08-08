<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportInventoryProductRequest extends FormRequest
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
            'inventory_products' => 'required|array|min:1',
            'inventory_products.*.id' => 'required|exists:inventory_products,id',
            'inventory_products.*.quantity' => 'required|integer|min:1|max:256',
        ];
    }
}
