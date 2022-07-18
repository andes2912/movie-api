<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'                  => ["required", "string", "max:80"],
            'email'                 => ["required", "string", "email", Rule::unique("users", "email")],
            'password'              => ["required", "string", "min:6"],
            'password_confirmation' => 'required_with:password|same:password|min:6|max:255',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'code'      => (int) 422,
                'message'   => (string) config('code.'. 422, "The given data was invalid."),
                'data'      => $validator->errors(),
                'error'     => null
            ], 422)
        );
    }
}
