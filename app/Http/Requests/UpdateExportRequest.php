<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExportRequest extends FormRequest
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
            "bill_number" => "required|unique:exports,bill_number," . $this->export,
            "shipping_charge_price" => "required|integer|min:1|max:256",
            "dealer_id" => "required|exists:dealers,id",
            "total_price" => "min:1|max:256",
            "has_received" => "min:0|max:1|in:0,1",
        ];
    }
}
