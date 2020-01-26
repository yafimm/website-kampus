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
        'stock' => 'required|integer',
        'harga' => 'required|integer',
        'satuan' => 'required|string',
      ];
    }
}
