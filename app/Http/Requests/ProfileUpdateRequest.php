<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:50'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:50',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            // NIM sekarang BOLEH diisi/diubah user, tapi statusnya akan
            // otomatis reset ke "belum diverifikasi" setiap kali diubah
            // (lihat ProfileController@update).
            'nomor_induk' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048', // 2MB
            ],

            // PENTING: 'role' SENGAJA TIDAK didaftarkan di sini.
            // Meskipun user mengirim field ini lewat request manual (misal Postman/curl),
            // Laravel hanya memvalidasi & memakai field yang ada di rules() ini,
            // dan ProfileController tidak pernah membacanya dari input user.
        ];
    }
}