<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FamilyMemberRequest extends FormRequest
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
            'head_of_family_id' => 'required|integer',
            'name' => 'required|string|max:50',
            'birthdate' => 'required|date',
            'marital_status' => 'required|integer|in:1,0',
            'wedding_date' => 'required_if:marital_status, !=, 1',
            'education' => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpeg,jpg,png',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'head_of_family_id.required' => 'Head of family is required!',
            'name.required' => 'Surname is required!',
            'birthdate.required' => 'Birthdate is required!',
            'marital_status.required' => 'Marital Status is required!',
            'wedding_date.required_if' => 'Wedding Date is required!',
            'education.required' => 'Education is required!',
            'photo.required' => 'Photo is required!',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 201));
    }
}
