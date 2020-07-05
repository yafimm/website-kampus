<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Peminjaman Inventaris</title>
		<meta http-equiv="Content-Type" content="charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
		.tab {
       display:inline-block;
       margin-left: 40px;
		 }
		 .peminjam{
			 margin: 20px 0px;
		 }
		 .keterangan{
			 margin-left: 500px;
		 }
		 .nama{
			 margin-top: 100px;
		 }
		 .ttl{
			 margin: 30px 0px;
		 }
	</style>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" width="10%"><img src="{{ asset('assets/images-resource/apple-icon-72x72.png') }}"></td>
            <td align="center" width="80%" style="font-size:20px;"><br>
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
		<h5><u>SURAT KETERANGAN PEMINJAMAN BARANG</u></h4>
		<h6>No : {{ $data_peminjaman->p_id }}</h6>
	</center>
	<p>Pihak Peminjam : </p>
	<div class="peminjam">
		<p><span class="tab"></span>NPM :  {{ $data_peminjaman->user ? $data_peminjaman->user->npm : '- Data pengguna sudah dihapus -' }}
		<p><span class="tab"></span>Nama Peminjam : {{ $data_peminjaman->user ? $data_peminjaman->user->name : '- Data pengguna sudah dihapus -' }}</p>
		<p><span class="tab"></span>Tanggal Kegiatan : {{ date('d/m/Y', strtotime($data_peminjaman->p_date)) }}</p>
		<p><span class="tab"></span>Nama Kegiatan : {{ $data_peminjaman->p_nama_event }}</p>
	</div>

	<p>Menerangkan bahwa telah MENGEMBALIKAN barang sesuai pada data dibawah ini : </p>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No </th>
        <th>Nama Inventaris</th>
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

	<div class="keterangan">
		<div class="ttl">
			Bandung, {{ date('d M Y', strtotime($data_peminjaman->p_date_start)) }}
		</div>
		<div>
			Mengetahui :
		</div>
	</div>
	<div class="container nama">
		<div class="row">
			<div class="col-xs-7">
				<u>{{ $data_peminjaman->user ? $data_peminjaman->user->name : '- Data pengguna sudah dihapus -' }}</u><br>
				PEMINJAM
			</div>
			<div class="col-xs-5">
				<u>Staff</u><br>
				STAFF INVENTARIS
			</div>
		</div>
	</div>


</body>
</html>
