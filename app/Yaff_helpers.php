<?php
if(!function_exists('YaffSetBarangKode')) {
    function YaffSetBarangKode() {
        $id = 'BRG'.date('ymd');
        $lastId = DB::table('barang')->where('b_kode','like', $id.'%')->orderBy('b_id', 'DESC')->first();
        if($lastId){
            $count = substr($lastId->b_kode, 9);
            $count++;
            if(strlen($count) == 1){
                $count='00'.$count;
            }
            else if(strlen($count) == 2){
                $count='0'.$count;
            }
            else{
                $count = $count;
            }
            if($count)
                $id .= $count;
            }else{
                $id .= '001';
            }
        return $id;
    }
}

if(!function_exists('YaffSetInventarisKode')) {
    function YaffSetInventarisKode() {
        $id = 'INV'.date('ymd');
        $lastId = DB::table('inventaris')->where('i_kode','like', $id.'%')->orderBy('i_id', 'DESC')->first();
        if($lastId){
            $count = substr($lastId->i_kode, 9);
            $count++;
            if(strlen($count) == 1){
                $count='00'.$count;
            }
            else if(strlen($count) == 2){
                $count='0'.$count;
            }
            else{
                $count = $count;
            }
            if($count)
                $id .= $count;
            }else{
                $id .= '001';
            }
        return $id;
    }
}

if(!function_exists('YaffSetPengadaanNoRegister')) {
    function YaffSetPengadaanNoRegister() {
        $id = 'PNGD'.date('ymd');
        $lastId = DB::table('pengadaan')->where('no_register','like', $id.'%')->orderBy('no_register', 'DESC')->first();
        if($lastId){
            $count = substr($lastId->no_register, 9);
            $count++;
            if(strlen($count) == 1){
                $count='00'.$count;
            }
            else if(strlen($count) == 2){
                $count='0'.$count;
            }
            else{
                $count = $count;
            }
            if($count)
                $id .= $count;
            }else{
                $id .= '001';
            }
        return $id;
    }
}

if(!function_exists('YaffSetMaintenanceNoRegister')) {
    function YaffSetMaintenanceNoRegister() {
        $id = 'MNTS'.date('ymd');
        $lastId = DB::table('maintenance')->where('no_register','like', $id.'%')->orderBy('no_register', 'DESC')->first();
        if($lastId){
            $count = substr($lastId->no_register, 9);
            $count++;
            if(strlen($count) == 1){
                $count='00'.$count;
            }
            else if(strlen($count) == 2){
                $count='0'.$count;
            }
            else{
                $count = $count;
            }
            if($count)
                $id .= $count;
            }else{
                $id .= '001';
            }
        return $id;
    }
}



if(!function_exists('getMonth')){
   function getMonth($month) {
      $bulan = 'none';
      switch ($month) {
          case '01':
              $bulan = 'Januari';
              break;
          case '02':
              $bulan = 'Februari';
              break;
          case '03':
              $bulan = 'Maret';
              break;
          case '04':
              $bulan = 'April';
              break;
          case '05':
              $bulan = 'Maret';
              break;
          case '06':
              $bulan = 'Juni';
              break;
          case '07':
              $bulan = 'Juli';
              break;
          case '08':
              $bulan = 'Agustus';
              break;
          case '09':
              $bulan = 'September';
              break;
          case '10':
              $bulan = 'Oktober';
              break;
          case '11':
              $bulan = 'November';
              break;
          case '12':
              $bulan = 'Desember';
              break;
          default:
              $bulan = 'Gak Ada';
              break;
      }
      return $bulan;
    }
}
