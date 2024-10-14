<?php

namespace App\Http\Requests;

class DocumentUploadRequest extends BaseRequest
{
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
            'file' => 'required|file|mimes:pdf|max:10240',    // 10MB
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'File is required.',
            'file.mimes'    => 'Only PDF files are allowed.',
        ];
    }
}
