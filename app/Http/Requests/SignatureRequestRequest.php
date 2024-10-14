<?php

namespace App\Http\Requests;

class SignatureRequestRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file_id'   => 'required|exists:files,id',
            'signer_id' => 'required|exists:users,id',
        ];
    }
}
