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
	</center>
	<p><b>Nama Peminjaman : </b>{{ $data_peminjaman->user->name }}</p>
	<p><b>Tanggal Mulai : </b>{{ date('d/m/Y', strtotime($data_peminjaman->p_date)) }}</p>
	<p><b>Tanggal Berakhir : </b>{{ date('d/m/Y', strtotime($data_peminjaman->p_date_end)) }}</p>
	<p><b>Status : </b>{{ $data_peminjaman->user->name }}</p>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No </th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
			@if($data_peminjaman->inventaris)
				@foreach($data_peminjaman->inventaris as $key => $invenvaris)
				<tr>
					<td>{{ $key + 1 }}</td>
					<td>{{ $invenvaris->i_nama }}</td>
					<td>{{ $invenvaris->pivot->dp_jumlah }}</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>

</body>
</html>
