<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Barang</title>
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
		<h4>Laporan Data Barang</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Stock</th>
				<th>Harga</th>
				<th>Satuan</th>
				<th>Tanggal</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($data_barang as $barang)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$barang->b_nama}}</td>
				<td>{{$barang->b_stock}}</td>
				<td>{{$barang->b_harga}}</td>
				<td>{{$barang->b_satuan}}</td>
				<td>{{$barang->created_at}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
