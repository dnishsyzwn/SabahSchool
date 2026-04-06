<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
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
            'title'        => 'required|string|max:255',
            'category'     => 'required|string|max:100',
            'description'  => 'required|string',
            'image_urls'   => 'nullable|array',
            'image_urls.*' => 'required|string',
            'event_date'   => 'nullable|date',
            'location'     => 'nullable|string|max:255',
            'amount'       => 'nullable|string|max:255',
            'status'       => 'required|in:draft,published,archived',
            'is_featured'  => 'nullable|boolean',
        ];
    }
}
