<?php

namespace App\Lib\Base\Infrastructure\Request;

use Illuminate\Http\Response;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class GetAllRequest extends FormRequest
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
    public function rules() {
        return [
            'pagination.skip' => 'required',
            'pagination.limit' => 'required'
        ];
    }    

    public function failedValidation(Validator $validator) {
        
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],Response::HTTP_BAD_REQUEST));
    }

    public function messages() {

        return [

            'pagination.skip' => 'Pagination Skip es Requerido',
            'pagination.limit' => 'Pagination Limit es Requerido'

        ];
    }
}
