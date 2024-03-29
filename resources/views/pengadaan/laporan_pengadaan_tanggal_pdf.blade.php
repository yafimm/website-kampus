<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Laporan Data pengadaan</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" width="10%"><img src="{{ asset('assets/images-resource/apple-icon-72x72.jpg') }}"></td>
            <td align="center" width="80%" style="font-size:20px;"><strong><br>
                    <span style="font-size:20px">Sekolah Tinggi Manajemen Informatika dan Komputer
                        AMIKBANDUNG</span></strong>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="center">Jln. Jakarta no.28 Kota Bandung</td>
        </tr>
    </table>
    <hr style="border-top: 1px solid black;">
	<center>
		<h4>Laporan Data Pengadaan</h4>
		<p>{{ date('d/m/Y', strtotime($mulai)) }} - {{ date('d/m/Y', strtotime($akhir)) }}</p>
	</center>

  @foreach($data_pengadaan as $pengadaan)
			<p><b>No Register : </b> {{ $pengadaan[0]->no_register }}</p>
      <p><b>Toko/Supplier : </b> {{ $pengadaan[0]->supplier }}</p>
      <p><b>Tanggal : </b>{{ date('d/m/Y', strtotime($pengadaan[0]->tanggal)) }}</p>
      <p><b>Total : </b>Rp. {{ number_format($pengadaan->sum('total'), 2 ,',','.') }}</p>
  	<table class='table table-bordered'>
  		<thead>
  			<tr>
  				<th>No</th>
  				<th>Kode</th>
  				<th>Nama Barang/Inventaris</th>
  				<th>Jumlah</th>
  				<th>Biaya</th>
  				<th>Total</th>
  			</tr>
  		</thead>
  		<tbody>
  			@php $i=1 @endphp
  			@foreach($pengadaan as $pengadaan_detail)
  			<tr>
  				<td>{{ $i++ }}</td>
					<td>@if($pengadaan_detail->barang)
								{{$pengadaan_detail->barang->b_kode}}
							@elseif($pengadaan_detail->inventaris)
								{{$pengadaan_detail->inventaris->i_kode}}
							@else
								- Data Barang / Inventaris sudah dihapus -
							@endif
					</td>
					<td>@if($pengadaan_detail->barang)
								{{$pengadaan_detail->barang->b_nama}}
							@elseif($pengadaan_detail->inventaris)
								{{$pengadaan_detail->inventaris->i_nama}}
							@else
								- Data Barang / Inventaris sudah dihapus -
							@endif
					</td>
  				<td>{{$pengadaan_detail->qty}}</td>
  				<td>Rp. {{number_format($pengadaan_detail->biaya, 2, ',', '.')}}</td>
  				<td>Rp. {{number_format($pengadaan_detail->total, 2, ',','.')}}</td>
  			</tr>
  			@endforeach
  		</tbody>
			<tfoot>
				<tr>
					<th colspan="3" style="text-align: center; vertical-align: middle;">Total Keseluruhan</th>
					<th colspan="3" style="text-align: center; vertical-align: middle;">Rp. {{ number_format( $pengadaan->sum('total'), 2, ',', '.') }}</th>
				</tr>
			</tfoot>
  	</table>

  @endforeach

</body>
</html>
