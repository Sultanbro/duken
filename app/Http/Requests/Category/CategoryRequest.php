<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                $data['id'] = $this->route('category');
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
            'name' => ['required', 'string'],
            'parent_id' => ['integer', 'exists:categories,id'],
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                        'id' => 'required|integer|exists:categories,id',
                    ] + $rules;
            case 'GET':
                return [
                    'id' => 'integer|exists:categories,id',
                ];
            case 'DELETE':
                return [
                    'id' => 'required|integer|exists:categories,id',
                ];
        }
    }



}
