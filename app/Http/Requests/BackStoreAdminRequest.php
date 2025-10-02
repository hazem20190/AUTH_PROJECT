<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class BackStoreAdminRequest extends FormRequest
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
            'name' => 'required|string|max:256|min:3',
            'email' => 'required|email|unique:users,email|max:256',
            'password' => ['required', 'string', 'confirmed', Password::default()],
            'role' => 'nullable|exists:roles,name',
            'status' => 'required|in:0,1',
        ];
    }
}
