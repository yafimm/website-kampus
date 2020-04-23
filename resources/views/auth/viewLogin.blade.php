@extends('auth.app')
@section('content')
<div class="center-vertical">
    <div class="center-content row">
        <div class="col-md-4 top-margin" style="margin-left:10px">
            <h2 class="font-size-23" style="background-color: #079bef;color: #fff;padding:10px">Sistem Inventory Online
            </h2>
            <br>
            <h2 class="font-size-18" style="background-color: #fff;color: #079bef;padding:10px">Mudah, Cepat, Fleksibel.
            </h2>
        </div>
        <form action="{{ url('/login/authentication') }}" id="login-validation" class="col-md-4 col-sm-5 col-xs-11 col-lg-3 center-margin"
            style="margin-right:100px" method="post">
            {{ csrf_field() }}
            <h4 class="text-center pad25B font-black text-transform-upr font-size-23">Sistem Inventory Online <span
                    class="opacity-80">1.0</span></h4>
            <h4 class="text-center pad25B font-black text-transform-upr font-size-15">Masuk aplikasi</h4>
            <div id="login-form" class="content-box bg-default">
                <div class="content-box-wrapper pad20A">
                    <img class="mrg25B center-margin display-block" src="{{ asset('assets/images-resource/logo.png') }}"
                        alt="">
                    @include('_partial.flash_message')
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
                            <input type="password" class="form-control" id="exampleInputPassword1"
                                name="password" placeholder="Masukkan Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Masuk</button>
                    </div>
                    <div class="form-group">
                        <a href="{{ url('/register/mahasiswa') }}" class="btn btn-block btn-primary">Daftar Mahasiswa</a>
                    </div>
                    <div class="form-group">
                        <a href="{{ url('/register/dosen') }}" class="btn btn-block btn-primary">Daftar Dosen / Non Dosen</a>
                    </div>
                    <div class="row">
                        <div class="checkbox-primary col-md-8" style="height: 20px;margin-bottom:20px">
                            <a href="{{ url('/') }}" class="" style="height: 20px;margin-bottom:20px" title="Back Home">Ingin
                                kembali ke halaman utama ? Klik disini.</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-md-4" style="margin-left:10px">
            <h2 class="font-size-14" style="background-color: #079bef ;color: #fff;padding:10px">Sistem Inventory Online
                1.0 | 2019</h2>
        </div>
    </div>
</div>
@endsection
