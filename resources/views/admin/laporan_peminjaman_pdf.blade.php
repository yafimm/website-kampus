<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Peminjaman Inventaris</title>
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
		<h4>Laporan Data Peminjaman Inventaris</h4>
		<p>{{$data_status}}</p>
	</center>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pengguna</th>
                <th>Tanggal Mulai Peminjaman</th>
                <th>Tanggal Berakhir Peminjaman</th>
				<th>Status</th>
                <th>Daftar Inventaris</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($data_peminjaman as $peminjaman)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$peminjaman->name}}</td>
				<td>{{$peminjaman->p_date}}</td>
                <td>{{$peminjaman->p_date_end}}</td>
				<td>
                    @if ($peminjaman->p_status == 0)
                        Menunggu
                    @elseif($peminjaman->p_status == 1)
                        Disetujui
                    @elseif($peminjaman->p_status == 2)
                        Ditolak
                    @endif
                </td>
				<td>
                    @php $j=1 @endphp
                    @foreach ($peminjaman->detail_peminjaman as $detail_peminjaman)
                        {{ $j++ }}. {{$detail_peminjaman->i_nama}} : {{$detail_peminjaman->dp_jumlah}}<hr>
                    @endforeach
                </td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>