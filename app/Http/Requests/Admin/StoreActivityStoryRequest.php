<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityStoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'tag'          => ['nullable', 'string', 'max:100'],
            'description'  => ['nullable', 'string'],
            'event_date'   => ['required', 'date'],
            'image_urls'   => ['required', 'array', 'min:1', 'max:3'],
            'image_urls.*' => ['string'],
            'status'       => ['required', 'string', 'in:draft,published,archived'],
            'sort_order'   => ['nullable', 'integer'],
        ];
    }
}
