<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
    <style>
        body {
            padding-left: 40px;
            padding-right: 30px;
        }

        .pleft-table {
            padding-left: 40px;
            width: 36%;
        }

    </style>
</head>

<body>
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
    <br><br>
    <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><u>SURAT KETERANGAN PEMINJAMAN BARANG</u></td>
        </tr>
        <tr>
            <td align="center" style="padding-top: 10px;">No : {{$data_peminjaman[0]->nomor_surat}}</td>
        </tr>
    </table>
    <br>
    <p>Pihak Peminjam &nbsp;:</p>
    <br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        @if ($data_peminjaman[0]->role == 'dosen')
        <tr>
            <td class="pleft-table">NIP</td>
            <td>: {{$data_peminjaman[0]->nip}}</td>
        </tr>
        @endif
        @if ($data_peminjaman[0]->role == 'mahasiswa')
        <tr>
            <td class="pleft-table">NPM</td>
            <td>: {{$data_peminjaman[0]->npm}}</td>
        </tr>
        @endif
        <tr>
            <td class="pleft-table">Nama</td>
            <td>: {{$data_peminjaman[0]->name}}</td>
        </tr>
        <tr>
            <td class="pleft-table">Tanggal Kegiatan</td>
            <td>: {{$data_peminjaman[0]->p_date}}</td>
        </tr>
        <tr>
            <td class="pleft-table">Nama Kegiatan</td>
            <td>: {{$data_peminjaman[0]->p_nama_event}}</td>
        </tr>
    </table>
    <br><br>
    <p> Menerangkan bahwa telah disetujui peminjaman barang sesuai pada data dibawah &nbsp;:</p>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Inventaris</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($data_peminjaman[0]->detail_peminjaman as $inventaris)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$inventaris->i_nama}}</td>
                <td>{{$inventaris->dp_jumlah}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="60%" align="center">&nbsp;</td>
            <td width="40%">
                <div>Bandung,{{$data_peminjaman[0]->get_data_tanggal_ttd}}</div>
            </td>
        </tr>
        <tr>
            <td width="60%" align="center">&nbsp;</td>
            <td width="40%" style="padding-top:20px;">
                <div>Yang Menerangkan,</div>
            </td>
        </tr>
    </table>
    <br><br><br><br><br><br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="40%" align="center">&nbsp;</td>
            <td width="60%" align="center">
                <div>Kepala Bagian Umum</div>
            </td>
        </tr>
    </table>
</body>

</html>
