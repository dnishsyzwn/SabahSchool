<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClaimRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_name'         => ['required', 'string', 'max:255'],
            'heir_name'           => ['nullable', 'string', 'max:255'],
            'heir_relation'       => ['nullable', 'string', 'max:100'],
            'school'              => ['required', 'string', 'max:255'],
            'disease_type'        => ['required', 'string', 'max:255'],
            'claim_type'          => ['required', 'string', 'max:100'],
            'date_joined'         => ['required', 'string', 'max:100'],
            'date_incident'       => ['required', 'string', 'max:100'],
            'contribution_amount' => ['nullable', 'string', 'max:100'],
            'compensation_amount' => ['nullable', 'string', 'max:100'],
            'title'               => ['nullable', 'string', 'max:255'],
            'category'            => ['nullable', 'string', 'max:100'],
            'description'         => ['nullable', 'string'],
            'event_date'          => ['nullable', 'date'],
            'location'            => ['nullable', 'string', 'max:255'],
            'amount'              => ['nullable', 'string', 'max:100'],
            'status'              => ['required', 'in:draft,published,archived'],
            'is_featured'         => ['nullable', 'boolean'],
            'image_urls'          => ['nullable', 'array'],
            'image_urls.*'        => ['string'],
        ];
    }
}
