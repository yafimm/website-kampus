<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventarisRequest extends FormRequest
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
          $nama = 'required|string|min:4|max:50|unique:inventaris,i_nama';
          $foto = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
          $kode = 'required|string|min:4|max:50|unique:inventaris,i_kode';
        }else{
          $nama = 'required|string|min:5|max:50|unique:inventaris,i_nama,'.$this->get('id').',i_id';
          $kode = 'required|string|min:5|max:50|unique:inventaris,i_kode,'.$this->get('id').',i_id';
          $foto = 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        return [
          'nama' => $nama,
          'foto' => $foto,
          'kode' => $kode,
          'unit' => 'required|integer',
          'harga' => 'required|integer',
          'posisi' => 'required|string|min:3',
          'keterangan' => 'required|string|min:3'
        ];
    }
}
