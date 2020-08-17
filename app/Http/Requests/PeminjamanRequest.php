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
         'inp_nama_event' => 'required|string|min:4|max:255',
         'idinventaris' => 'required|array',
         'datestart' => 'required|date|before_or_equal:dateend|after_or_equal:'.date('Y-m-d'),
         'dateend' => 'required|date|after_or_equal:dateStart',
       ];
     }

     public function messages()
     {
          return [
              'idinventaris.required' => 'Inventaris untuk peminjaman tidak boleh kosong, minimal isikan 1 data !!',
              'inp_nama_event.required' => 'Nama event tidak boleh kosong',
              'inp_nama_event.min' => 'Nama Event minimal harus 4 karakter',
              'inp_nama_event.max' => 'Nama Event maksimal sampai 255 karakter',
              'datestart.date'=> 'Tanggal mulai harus menggunakan format yang benar d-m-Y',
              'datestart.before'=> 'Tanggal mulai tidak boleh melebihi dari tanggal berakhir',
              'datestart.after_or_equal'=> 'Tanggal mulai tidak boleh kurang dari hari ini',
              'dateend.date'=> 'Tanggal berakhir harus menggunakan format yang benar d-m-Y',
              'dateend.after_or_equal'=> 'Tanggal berakhir tidak boleh kurang dari hari ini',
          ];
     }
}
