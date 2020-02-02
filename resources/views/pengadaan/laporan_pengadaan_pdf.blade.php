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
		<p>No Register #{{ $data_pengadaan[0]->no_register }}</p>
		<p>{{ $data_pengadaan[0]->tanggal }}</p>
		<p>{{ $data_pengadaan[0]->supplier }}</p>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Nama Barang</th>
				<th>Jumlah</th>
				<th>Biaya</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($data_pengadaan as $pengadaan)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$pengadaan->kode}}</td>
				<td>{{$pengadaan->barang->b_nama}}</td>
				<td>{{$pengadaan->qty}}</td>
				<td>{{$pengadaan->biaya}}</td>
				<td>{{$pengadaan->total}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
