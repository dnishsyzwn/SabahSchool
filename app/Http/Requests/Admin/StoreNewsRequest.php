<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:news_categories,id'],
            'content'     => ['required', 'string'],
            'excerpt'     => ['nullable', 'string', 'max:500'],
            'thumbnail'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'status'      => ['required', 'in:draft,published,archived'],
        ];
    }
}
