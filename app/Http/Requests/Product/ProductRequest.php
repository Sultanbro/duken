<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @param null $keys
     * @return array
     */
    public function all($keys = null)
    {
        $data = parent::all($keys);
        switch ($this->getMethod())
        {
            case 'PUT':
            case 'GET':
            case 'DELETE':
                $data['id'] = $this->route('product');
        }
        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string'],
            'price' => ['integer', 'required',],
            'description' => ['required', 'string'],
            'indicator' => ['boolean'],
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                        'id' => 'required|integer|exists:products,id',
                    ] + $rules;
            case 'GET':
                return [
                    'id' => 'integer|exists:products,id',
                ];
            case 'DELETE':
                return [
                    'id' => 'required|integer|exists:products,id',
                ];
        }
    }
}
