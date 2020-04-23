<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Laporan Data Maintenance</title>
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
		<h4>Laporan Data Maintenance</h4>
		<p>No Register #{{ $data_maintenance[0]->no_register }}</p>
		<p>{{ date('d-m-Y', strtotime($data_maintenance[0]->tanggal_maintenance)) }}</p>
		<p>Rp. {{ number_format($data_maintenance->sum('biaya'), 2, ',', '.')  }}</p>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Kode</th>
				<th>Nama Barang/Inventaris</th>
				<th>Posisi</th>
				<th>Biaya</th>
				<th>Keterangan</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($data_maintenance as $maintenance)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$maintenance->kode}}</td>
				<td>@if($maintenance->barang)
							{{$maintenance->barang->b_nama}}
						@elseif($maintenance->inventaris)
							{{$maintenance->inventaris->i_nama}}
						@else
							- Data Barang / Inventaris sudah dihapus -
						@endif
				</td>
				<td>{{$maintenance->posisi}}</td>
				<td>Rp. {{number_format($maintenance->biaya, 2, ',', '.')}}</td>
				<td>{{$maintenance->keterangan}}</td>
				<td>
					@if ($maintenance->status == 'BELUM MULAI')
							<span class="text-danger">Belum Mulai</span>
					@elseif($maintenance->status == 'SEDANG BERJALAN')
							<span class="text-warning">Sedang Berjalan</span>
					@elseif($maintenance->status == 'SELESAI')
							<span class="text-success">Selesai</span>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
