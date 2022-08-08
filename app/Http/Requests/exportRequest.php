<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class exportRequest extends FormRequest
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

            "bill_number" => "required|unique:exports",
            "shipping_charge_price" => "required|integer|min:1|max:256",
            "dealer_id" => "required|exists:dealers,id",
            "total_price" => "min:1|max:256",
            "has_received" => "min:0|max:1|in:0,1",
            'inventory_products' => 'required|array|min:1',
            'inventory_products.*.id' => 'required|exists:inventory_products,id',
            'inventory_products.*.quantity' => 'required|integer|min:1|max:256',
        ];
    }
}
