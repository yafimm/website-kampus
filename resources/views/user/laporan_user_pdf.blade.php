<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Laporan Data User</title>
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
            <td align="center" width="10%"><img src="{{ asset('assets/images-resource/apple-icon-72x72.jpg') }}"></td>
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
		<h4>Laporan Data User</h4>
		<h6>{{ date('d/m/Y', strtotime($mulai)) .' - '. date('d/m/Y', strtotime($akhir)) }}</h6>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>NPM/NPK</th>
				<th>Nama</th>
				<th>Email</th>
				<th>No Telpon</th>
				<th>Hak Akses</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($data_users as $user)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$user->role == 'mahasiswa' ? $user->npm : $user->npk}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->email ? $user->email : '-'}}</td>
				<td>{{$user->no_telpon ? $user->no_telpon : '-' }}</td>
				<td>{{$user->role}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
