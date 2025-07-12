<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreKelasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_kelas' => ['required', 'string', 'max:255'],
            'jurusan_id' => ['required', 'exists:jurusan,id'],
            'guru_id' => ['required', 'exists:guru,id', 'unique:kelas,guru_id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'jurusan_id.required' => 'Jurusan wajib dipilih.',
            'jurusan_id.exists' => 'Jurusan yang dipilih tidak valid.',
            'guru_id.required' => 'Wali kelas wajib dipilih.',
            'guru_id.exists' => 'Wali kelas yang dipilih tidak valid.',
            'guru_id.unique' => 'Guru ini sudah menjadi wali kelas lain.',
        ];
    }
}
