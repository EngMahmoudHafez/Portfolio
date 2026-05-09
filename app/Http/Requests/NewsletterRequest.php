<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:newsletters,email|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already subscribed to our newsletter.',
        ];
    }
}
