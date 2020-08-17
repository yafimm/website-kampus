<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
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
         'inp_nama_event' => 'required|string|min:4',
         'idinventaris' => 'required|array',
         'dateStart' => 'required|before:dateEnd|after_or_equalr:'.date('Y-m-d'),
         'dateEnd' => 'required|after_or_equal:dateStart',
         'file' => 'required',
       ];
     }

     public function messages()
     {
          return [
              'barang_inventaris.required' => 'Barang/Inventaris untuk pengadaan tidak boleh kosong, minimal isikan 1 data !!',
              'toko.required' => 'Nama Toko/Orang yang maintenance harus diisi',
              'toko.min' => 'Nama Toko minimal harus 4 karakter',
              'toko.max' => 'Nama Toko maksimal sampai 100 karakter',
              'tanggal.date'=> 'Tanggal harus menggunakan format yang benar d-m-Y',
          ];
     }
}
