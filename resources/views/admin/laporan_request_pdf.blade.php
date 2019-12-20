<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Request Barang</title>
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
		<h4>Laporan Data Inventaris</h4>
		<p>{{$data_status}}</p>
	</center>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pengguna</th>
				<th>Nama Barang</th>
                <th>Jumlah</th>
				<th>Status</th>
				<th>Tanggal</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($data_request as $request)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$request->name}}</td>
				<td>{{$request->b_nama}}</td>
                <td>{{$request->rb_jumlah}}</td>
				<td>
                    @if ($request->rb_status == 0)
                        Menunggu
                    @elseif($request->rb_status == 1)
                        Ditolak
                    @elseif($request->rb_status == 2)
                        Disetujui
                    @endif
                </td>
				<td>{{$request->created_at}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>