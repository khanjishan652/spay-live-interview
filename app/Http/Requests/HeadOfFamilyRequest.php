<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class HeadOfFamilyRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'birthdate' => 'required|date|before:'.now()->subYears(21)->toDateString(),
            'mobile_no' => 'required|numeric|digits_between:9,11|unique:head_of_families,mobile_no',
            'state_id' => 'required|integer',
            'city_id' => 'required|integer',
            'address' => 'required|string|max:100',
            'pincode' => 'required|numeric|digits_between:4,7',
            'marital_status' => 'required|integer|in:1,0',
            'wedding_date' => 'required_if:marital_status, !=, 1',
            'hobbies' => 'required|string|max:100',
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
            'name.required' => 'Name is required!',
            'surname.required' => 'Surname is required!',
            'birthdate.required' => 'Birthdate is required!',
            'mobile_no.required' => 'Mobile No is required!',
            'state_id.required' => 'State is required!',
            'city_id.required' => 'City is required!',
            'address.required' => 'Address is required!',
            'pincode.required' => 'Pincode is required!',
            'marital_status.required' => 'Marital Status is required!',
            'wedding_date.required_if' => 'Wedding Date is required!',
            'hobbies.required' => 'Hobbies is required!',
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
