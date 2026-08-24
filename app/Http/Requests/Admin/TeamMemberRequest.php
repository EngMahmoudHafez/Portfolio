<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TeamMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:team_members,slug,' . $this->route('teamMember')?->id,
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:100',
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'string|max:50',
            'social_links.*.url' => 'url|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ];
    }
}
