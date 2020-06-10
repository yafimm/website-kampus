@extends('auth.app')
@section('content')
<main class="login-container">
    <div class="row page-login align-items-center">
        <div class="container">
            <div class="section-content col-12 col-md-12">
                <div class="card container card-details mb-4">
                    <h2>Mahasiswa</h2>
                </div>
                <div class="card container card-register">
                    <img src="{{ asset('assets/images-resource/LOGO-PNG.png') }}" alt="logo" class="logo">
                    <form action="{{ url('/register/regist') }}" id="login-validation" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon addon-inside bg-gray">
                                    <i class="glyph-icon icon-user"></i>
                                </span>
                                <input required type="text" class="form-control" id="npm" name="npm"
                                    placeholder="Masukkan NPM">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon addon-inside bg-gray">
                                    <i class="glyph-icon icon-user"></i>
                                </span>
                                <input required type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon addon-inside bg-gray">
                                    <i class="glyph-icon icon-user"></i>
                                </span>
                                <input required type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan Nama">
                                <input type="hidden" class="form-control" id="role" name="role" value="mahasiswa">
                                <input type="hidden" class="form-control" id="nip" name="nip" value="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon addon-inside bg-gray">
                                    <i class="glyph-icon icon-unlock-alt"></i>
                                </span>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                    placeholder="Masukkan Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Daftar</button>
                        </div>
                        <div class="row">
                            <div class="checkbox-primary col-md-8" style="height: 20px;margin-bottom:20px">
                                <a href="{{ url('/') }}" class="" style="height: 20px;margin-bottom:20px"
                                    title="Back Home">Ingin
                                    kembali ke halaman utama ? Klik disini.</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection