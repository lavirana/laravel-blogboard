<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StorePostRequest extends FormRequest

{
    // Who is allowed to make this request?
    public function authorize(): bool
    {
        return auth()->check(); // must be logged in
    }
    // Validation rules
    public function rules(): array
    {

        return [
            'title'       => ['required', 'string', 'min:5', 'max:255'],
            'body'        => ['required', 'string', 'min:100'],
            'excerpt'     => ['nullable', 'string', 'max:500'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'tags'        => ['nullable', 'array'],
            'tags.*'      => ['exists:tags,id'],
            'status'      => ['required', 'in:draft,published'],
            'published_at'=> ['nullable', 'date', 'required_if:status,published'],
        ];

    }

    // Custom error messages

    public function messages(): array

    {
        return [
            'title.min'  => 'The title must be at least 5 characters.',
            'body.min'   => 'The post body must be at least 100 characters.',
            'tags.*.exists' => 'One or more selected tags are invalid.',
        ];
    }
}

