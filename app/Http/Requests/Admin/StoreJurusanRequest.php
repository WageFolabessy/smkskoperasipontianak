<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreJurusanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_jurusan' => ['required', 'string', 'max:255', 'unique:jurusan,nama_jurusan'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_jurusan.required' => 'Nama jurusan wajib diisi.',
            'nama_jurusan.string' => 'Nama jurusan harus berupa teks.',
            'nama_jurusan.max' => 'Nama jurusan tidak boleh lebih dari 255 karakter.',
            'nama_jurusan.unique' => 'Nama jurusan ini sudah terdaftar.',
        ];
    }
}
