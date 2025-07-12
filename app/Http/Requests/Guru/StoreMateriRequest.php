<?php

namespace App\Http\Requests\Guru;

use Illuminate\Foundation\Http\FormRequest;

class StoreMateriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajaran,id'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul materi wajib diisi.',
            'kelas_id.required' => 'Kelas wajib dipilih.',
            'mata_pelajaran_id.required' => 'Mata pelajaran wajib dipilih.',
            'file.required' => 'File materi wajib diunggah.',
            'file.file' => 'Unggahan harus berupa file.',
            'file.mimes' => 'Format file harus: pdf, doc, docx, ppt, pptx, xls, xlsx.',
            'file.max' => 'Ukuran file maksimal 10MB.',
        ];
    }
}
