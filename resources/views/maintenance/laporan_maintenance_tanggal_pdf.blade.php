<!DOCTYPE html>
<html>
<head>
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
            <td align="center" width="10%"><img src="{{ asset('assets/images-resource/apple-icon-72x72.png') }}"></td>
            <td align="center" width="80%" style="font-size:20px;">Bagian Umum<strong><br>
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

  @foreach($data_maintenance as $maintenance)
      <p><b>No Register : </b> {{ $maintenance[0]->no_register }}</p>
      <p><b>Tanggal : </b>{{ date('d/m/Y', strtotime($maintenance[0]->tanggal_maintenance)) }}</p>
      <p><b>Total : </b>Rp. {{ number_format($maintenance->sum('biaya'), 2 ,',','.') }}</p>
  	<table class='table table-bordered'>
  		<thead>
  			<tr>
  				<th>No</th>
  				<th>Kode</th>
  				<th>Nama Barang</th>
  				<th>Biaya</th>
					<th>Keterangan</th>
					<th>Status</th>
  			</tr>
  		</thead>
  		<tbody>
  			@php $i=1 @endphp
  			@foreach($maintenance as $maintenance_detail)
  			<tr>
  				<td>{{ $i++ }}</td>
  				<td>{{ $maintenance_detail->barang ? $maintenance_detail->barang->b_kode : '- Data sudah dihapus -' }}</td>
  				<td>{{ $maintenance_detail->barang ? $maintenance_detail->barang->b_nama : '- Data sudah dihapus -' }}</td>
  				<td>Rp. {{number_format($maintenance_detail->biaya, 2, ',', '.')}}</td>
					<td>{{ $maintenance_detail->keterangan }}</td>
					<td>
							@if($maintenance_detail->status == 'BELUM MULAI')
								<span class="text-danger">Belum Mulai</span>
							@elseif($maintenance_detail->status == 'SEDANG BERJALAN')
								<span class="text-warning">Sedang Berjalan</span>
							@else
								<span class="text-success">Selesai</span>
							@endif
					</td>
  			</tr>
  			@endforeach
  		</tbody>
  	</table>

  @endforeach

</body>
</html>
