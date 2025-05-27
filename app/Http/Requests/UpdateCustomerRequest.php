<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'name' => 'required|string|max:255', // Required field, max length 255
            'company_name' => 'nullable|string|max:255', // Optional field, max length 255
            'email' => 'nullable|email|max:255|unique:customers,email,' . $this->customer, // Optional, must be unique except for this customer
            'phone' => 'nullable|string|max:15', // Optional field, max length 15
            'gst' => 'nullable|string|max:20', // Optional field, max length 20
            'address' => 'required|string|max:500', // Required field, max length 500
            'status' => 'nullable|in:0,1', // Optional field, must be 'active' or 'inactive'
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name must not exceed 255 characters.',
            'address.required' => 'The address field is required.',
            'address.max' => 'The address must not exceed 500 characters.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}
