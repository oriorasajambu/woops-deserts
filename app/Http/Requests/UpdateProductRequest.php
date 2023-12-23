<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category'    => 'required',
            'name'        => 'required|min:5',
            'slug'        => 'unique:products,slug,'.$this->id,
            'description' => 'required|min:5',
            'price'       => 'required|numeric',
            'image'       => 'required|mimes:jpeg,png,jpg,gif|max:4096',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'name' => Str::title($this->name),
            'slug' => Str::slug($this->name),
            'description' => Str::title($this->description),
        ]);
    }
}
