<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class LeadAddRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name|alpha' => 'max:255',
            'last_name|alpha' => 'max:255',
            'email' => 'max:255|email',
            'telephone' => 'max:255',
            'privacy' => 'required|boolean',
            'privacy_marketing' => 'boolean',
            'privacy_third_party' => 'boolean',
            'campaign_id' => 'required|numeric'
        ];
    }

    /**
     * Throw the right ValidationException in case of failure
     *
     * @param Validator $validator
     * @return void
     */    
    public function failedValidation(Validator $validator)
    {
        $response = new Response([
            'message' => "The given data was invalid.",
            'errors' => $validator->errors()
            // 'error' => $validator->errors()->first()
        ], 422);
        throw new ValidationException($validator, $response);
    }
}
