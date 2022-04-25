<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBarangRequest extends FormRequest
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
            'nama_barang'   => ['required', 'min:4'],
            'harga_barang'  => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'nama_barang.required'  => "Nama barang wajib diisi!",
            'nama_barang.min'       => "Nama barang minimum 4 karakter",
            'harga_barabg'          => "Harga barang wajib diisi",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
