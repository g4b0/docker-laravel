<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class LeadAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'email' => 'max:255|email',
            'telepone' => 'max:255',
            'privacy' => 'required|boolean',
            'privacy' => 'boolean',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = new Response(['error' => $validator->errors()->first()], 422);
        throw new ValidationException($validator, $response);

        // throw new HttpResponseException(response()->json([
        //     'success'   => false,
        //     'message'   => 'Validation errors',
        //     'data'      => $validator->errors()
        // ]));
    }
}
