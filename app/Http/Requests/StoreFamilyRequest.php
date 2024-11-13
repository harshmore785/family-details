<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthdate' => 'required|date|before:-21 years',
            'mobile_no' => 'required|digits:10',
            'address' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'pincode' => 'required|digits:6',
            'marital_status' => 'required|in:Married,Unmarried',
            'wedding_date' => 'nullable|date|required_if:marital_status,Married',
            'hobbies.*' => 'nullable|string|max:50',
            'photo' => 'nullable|image|max:2048',

            'family_members.*.name' => 'required|string|max:255',
            'family_members.*.birthdate' => 'required|date',
            'family_members.*.marital_status' => 'required|in:Married,Unmarried',
            'family_members.*.wedding_date' => 'nullable|date|required_if:family_members.*.marital_status,Married',
            'family_members.*.education' => 'nullable|string|max:100',
            'family_members.*.photo' => 'nullable|image|max:2048',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'surname.required' => 'The surname field is required.',
            'birthdate.before' => 'The head of the family must be at least 21 years old.',
            'mobile_no.digits' => 'The mobile number must be 10 digits.',
            'address.required' => 'The address field is required.',
            'state.required' => 'Please select a state.',
            'city.required' => 'Please select a city.',
            'pincode.digits' => 'The pincode must be 6 digits.',
            'marital_status.required' => 'Please select a marital status.',
            'wedding_date.required_if' => 'The wedding date is required if married.',
            'photo.image' => 'The photo must be an image file.',
            'family_members.*.name.required' => 'Each family member’s name is required.',
            'family_members.*.birthdate.required' => 'Each family member’s birthdate is required.',
            'family_members.*.wedding_date.required_if' => 'Wedding date is required if married.',
        ];
    }
}
