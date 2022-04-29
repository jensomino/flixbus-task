<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpCode;

class BaseApiFormReqs extends FormRequest
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
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        Log::error('['.__CLASS__.'][failedValidation] Form Request Validation Exception');
        throw new HttpResponseException(response()->json(['data' => 'failed','message' => $validator->getMessageBag()],HttpCode::HTTP_UNPROCESSABLE_ENTITY));
    }

}
