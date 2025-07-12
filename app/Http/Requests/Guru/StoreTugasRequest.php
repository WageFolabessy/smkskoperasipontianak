<?php

namespace App\Http\Requests\Guru;

use Illuminate\Foundation\Http\FormRequest;

class StoreTugasRequest extends FormRequest
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
            'batas_waktu' => ['required', 'date'],
            'file_soal' => ['required', 'file', 'mimes:pdf,doc,docx,zip,rar', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul tugas wajib diisi.',
            'kelas_id.required' => 'Kelas wajib dipilih.',
            'mata_pelajaran_id.required' => 'Mata pelajaran wajib dipilih.',
            'batas_waktu.required' => 'Batas waktu wajib diisi.',
            'batas_waktu.date' => 'Format batas waktu tidak valid.',
            'file_soal.required' => 'File soal wajib diunggah.',
            'file_soal.file' => 'Unggahan harus berupa file.',
            'file_soal.mimes' => 'Format file harus: pdf, doc, docx, zip, atau rar.',
            'file_soal.max' => 'Ukuran file soal maksimal 10MB.',
        ];
    }
}
