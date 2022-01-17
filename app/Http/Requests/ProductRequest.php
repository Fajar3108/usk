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
        $role =  strtolower(auth()->user()->roleName);
        return $role == 'admin' || $role == 'seller';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => ['required', 'image','max:2048'],
            'name' => ['required', 'min:5', 'max:50'],
            'description' => ['max:200'],
            'price' => ['required', 'numeric']
        ];
    }
}
