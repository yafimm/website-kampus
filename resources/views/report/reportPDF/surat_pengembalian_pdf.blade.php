<!DOCTYPE html>
<html>
<head>
	<title>Laporan Data Peminjaman Inventaris</title>
		<meta http-equiv="Content-Type" content="charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
		<style type="text/css">
		@media print {
    body{
        width: 21cm;
        height: 29.7cm;
        margin: 30mm 45mm 30mm 45mm;
        /* change the margins as you want them to be. */
		 }
		}

		table tr td,
		table tr th{
			font-size: 9pt;
		}
		.page-break {
			page-break-after: always;
		}
		.tab {
			display:inline-block;
			margin-left: 40px;
		}
		.peminjam{
			margin: 20px 0px;
		}
		.nama{
			margin-top: 100px;
		}
		.content-pdf{
			font-size: 11px;
		}
	</style>
</head>
<body>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
							<td align="center" width="10%"><img src="{{ public_path('assets/images-resource/apple-icon-72x72.jpg') }}"></td>
							<td align="center" width="80%" style="font-size:20px;"><br>
											<strong><span style="font-size:20px">Sekolah Tinggi Manajemen Informatika dan Komputer
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
			<h5><u>Laporan Data Barang</u></h4>
			<h6>Tanggal</h6>
		</center>

		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>NO</th>
					<th>KODE</th>
					<th>NAMA</th>
					<th>STOK</th>
					<th>HARGA</th>
					<th>TANGGAL</th>
					<th>TOTAL</th>
				</tr>
			</thead>
			<tbody>
				@if($arr_barang)
					@foreach($arr_barang as $key => $barang)
					<tr>
						<td>{{ $key + 1 }}</td>
						<td>{{ $barang->b_kode }}</td>
						<td>{{ $barang->b_nama }}</td>
						<td>{{ $barang->b_stock }}</td>
						<td>{{ $barang->b_harag}}</td>
						<td>{{ $barang->created_at->format('d-m-Y') }}</td>
						<td>{{ $barang->total }}</td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>

</body>
</html>
