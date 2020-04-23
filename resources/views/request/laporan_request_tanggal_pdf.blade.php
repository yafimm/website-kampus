<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
		<h4>Laporan Data Request Barang</h4>
		<h6>{{ date('d/m/Y', strtotime($mulai)) .' - '. date('d/m/Y', strtotime($akhir)) }}</h6>

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
				<td>{{$request->user->name}}</td>
				<td>{{$request->barang ? $request->barang->b_nama : ' - '}}</td>
        <td>{{$request->rb_jumlah}}</td>
				<td>
                    @if ($request->rb_status == 0)
                        <span class="text-warning">Menunggu</span>
                    @elseif($request->rb_status == 1)
                        <span class="text-danger">Ditolak</span>
                    @elseif($request->rb_status == 2)
                        <span class="text-primary">Disetujui</span>
										@else
												<span class="text-success">Selesai</span>
                    @endif
                </td>
				<td>{{$request->created_at->format('d/m/Y')}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
