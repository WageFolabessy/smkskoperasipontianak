<?php

namespace App\Http\Requests\Siswa;

use Illuminate\Foundation\Http\FormRequest;

class StoreJawabanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file_jawaban' => ['required', 'file', 'mimes:pdf,doc,docx,zip,rar,jpg,jpeg,png', 'max:10240'],
            'catatan' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'file_jawaban.required' => 'File jawaban wajib diunggah.',
            'file_jawaban.file' => 'Unggahan harus berupa file.',
            'file_jawaban.mimes' => 'Format file harus: pdf, doc, docx, zip, rar, atau gambar.',
            'file_jawaban.max' => 'Ukuran file jawaban maksimal 10MB.',
        ];
    }
}
