<?php

namespace App\Http\Requests\Sale;

use Alvarofpp\ExpandRequest\Traits\UrlParameters;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
{
    use UrlParameters;

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
            'sales' => ['required', 'exists:sales,id',],
        ];
    }
}
