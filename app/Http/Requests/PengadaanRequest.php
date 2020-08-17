<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengadaanRequest extends FormRequest
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
         $no_register = 'required|string';
         $supplier = 'required|string|min:4|max:100';
       }else{
         $no_register = 'required|string';
         $supplier = 'required|string|min:4|max:100';
       }

       return [
         'no_register' => $no_register,
         'supplier' => $supplier,
         'tanggal' => 'date',
         'barang_inventaris' => 'filled|required|array',
       ];
     }

     public function messages()
     {
          return [
              'barang_inventaris.required' => 'Barang/Inventaris untuk pengadaan tidak boleh kosong, minimal isikan 1 data !!',
              'supplier.required' => 'Nama supplier/Orang yang maintenance harus diisi',
              'supplier.min' => 'Nama supplier minimal harus 4 karakter',
              'supplier.max' => 'Nama supplier maksimal sampai 100 karakter',
              'tanggal.date'=> 'Tanggal harus menggunakan format yang benar d-m-Y',
          ];
     }
}
