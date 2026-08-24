<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,' . $this->route('project')?->id,
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'remove_gallery' => 'nullable|array',
            'remove_gallery.*' => 'string',
            'technologies' => 'nullable|array',
            'technologies.*' => 'string|max:100',
            'live_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'completed_at' => 'nullable|date',
            'sort_order' => 'nullable|integer',
        ];
    }
}
