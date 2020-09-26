<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'description' => ['required', 'string', 'min:3', 'max:255',],
            'price' => ['required', 'numeric',],
            'code' => ['string', 'min:8', 'max:8',],
            'sale_price' => ['required', 'numeric'],
            'image' => ['image'],
            'available' => ['boolean'],
        ];
    }
}
