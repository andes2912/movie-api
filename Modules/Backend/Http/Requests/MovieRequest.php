<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class MovieRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'title'             => 'required|unique:movies,title',
        'thumbnail'         => 'required|mimes:jpg,jpeg,png|max:3000',
        'description'       => 'required',
        'genre'             => 'required',
        'adult'             => ["required", Rule::in('0','1')],
        'release_date'      => 'required|date',
        'url_trailer'       => 'required',
        'link.*.url_movie'  => 'required'
      ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
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
