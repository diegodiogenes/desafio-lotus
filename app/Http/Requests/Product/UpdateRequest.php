<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'description' => ['string', 'min:3', 'max:255',],
            'price' => ['numeric',],
            'code' => ['string', 'min:8', 'max:8',],
            'sale_price' => ['numeric'],
            'image' => ['image'],
            'available' => ['boolean'],
        ];
    }
}
