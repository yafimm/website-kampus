<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
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

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      if($this->method() == 'POST'){
        $nama = 'required|string|min:4|max:50|unique:barang,b_nama';
        $foto = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        $kode = 'required|string|min:4|max:50|unique:barang,b_kode';
      }else{
        $nama = 'required|string|min:5|max:50|unique:barang,b_nama,'.$this->get('id').',b_id';
        $kode = 'sometimes|string|min:5|max:50|unique:barang,b_kode,'.$this->get('id').',b_id';
        $foto = 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
      }

      return [
        'nama' => $nama,
        'foto' => $foto,
        'kode' => $kode,
        'harga' => 'required|integer',
        'satuan' => 'required|string',
      ];
    }

    public function messages()
    {
         return [
             'nama.required' => 'Nama barang tidak boleh kosong',
             'nama.min' => 'Nama barang minimal harus 4 karakter',
             'nama.max' => 'Nama barang maksimal hanya sampai 50 karakter',
             'nama.unique' => 'Nama barang sudah ada didatabase',
             'foto.required' => 'Foto barang harus diupload',
             'foto.image' => 'Foto harus berformat gambar',
             'foto.mimes' => 'Foto harus berformat : jpeg, png, gif, svg',
             'foto.max' => 'Foto maksimal berukuran 2048KB (2MB)',
             'kode.required' => 'Kode tidak boleh kosong',
             'kode.min' => 'Kode minimal harus 4 karakter',
             'kode.max' => 'Kode makimal hanya sampai 50 karakter',
             'kode.unique' => 'Kode barang sudah digunakan didatabse',
             'harga.required' => 'Harga tidak boleh kosong',
             'harga.integer' => 'Harga harus berformat angka',
             'satuan.required' => 'Satuan tidak boleh kosong',
             'satuan.string' => 'Satuan harus berformat string',
         ];
    }

}
