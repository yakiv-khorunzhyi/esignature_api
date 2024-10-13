<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ApiResponse;

class BaseRequest extends FormRequest
{
    use ApiResponse;

    /**
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return never
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator): never
    {
        throw new ValidationException($validator, $this->responseUnprocessableEntity($validator->errors()->toArray()));
    }
}
