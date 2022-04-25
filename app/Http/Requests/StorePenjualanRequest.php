<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePenjualanRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_barang'     => ['required'],
            'nama_pembeli'  => ['required', 'min:3'],
            'no_hp'         => ['required', 'min:10', 'numeric'],
            'jml_barang'    => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'unique'        => ':attribute sudah terdaftar.',
            'min'           => ':attribute minimal 3 karakter.',
            'required'      => ':attribute wajib diisi.',
            'numeric'       => ':attribute hanya menggunakan nomor',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
