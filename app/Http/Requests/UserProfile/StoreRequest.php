<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'surname' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'education' => ['nullable', 'string', 'max:255'],
            'birthday' => ['required', 'date', 'before:today'],
            'sex' => ['required', 'in:male,female'],
            'gender' => ['nullable', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'max:255'],
        ];

    }
}
