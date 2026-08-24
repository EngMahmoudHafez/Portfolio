<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Derive the slug from the name when the field is left blank, so the
     * uniqueness rule below validates the value that actually gets saved.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->input('slug') ?: $this->input('name')),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $this->route('category')?->id,
            'type' => 'required|in:project,blog',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
        ];
    }
}
