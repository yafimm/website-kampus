@extends('auth.app')
@section('content')
<main class="login-container">
    <div class="container pt-5">
        <div class="row page-login">
            <div class="section-left col col-md-6 align-self-center">
                <h1 class="title">Welcome To
                    STMIK AMIK Bandung
                </h1>
                <br>
                <p class="paragraf">STMIK “AMIKBANDUNG” mendukung program pemerintah untuk kemandirian di bidang maritim
                    khususnya sistem navigasi dan teknologi pertahanan.</p>
                <div class="row button">
                    <a class="btn btn-primary btn-sm mahasiswa" href="{{ url('/register/mahasiswa') }}"
                        role="button">Daftar Mahasiswa</a>
                    <a class="btn btn-primary btn-sm mahasiswa" href="{{ url('/register/dosen') }}" role="button">Daftar
                        Dosen / Non Dosen</a>
                </div>
            </div>
            <div class="section-right col col-md-6">
                <div class="card container card-login">
                    <img src="{{ asset('assets/images-resource/LOGO-PNG.png') }}" alt="logo" class="logo">
                    <form action="{{ url('/login/authentication') }}" id="login-validation" method="post">
                        {{ csrf_field() }}
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
                                    <i class="glyph-icon icon-unlock-alt"></i>
                                </span>
                                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                    placeholder="Masukkan Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Masuk</button>
                        </div>
                    </form>
                    <div class="link-back">
                        <a href="{{ url('/') }}" class="" title="Back Home">Ingin
                            kembali ke halaman utama ? Klik disini.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection