@inject('TransServiceRequisition', 'App\Http\Controllers\DataPreferensi\DataPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')


@stop

@section('content')

    <h3 class="page-title">
        <b>Tambah Data Tes</b> <small>Mengelola Data Tes</small>
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Form Tambah Data Tes
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('datates') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        @if (Session::get('Success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::get('Fail'))
            <div class="alert alert-danger">
                {{ Session::get('Fail') }}
            </div>
        @endif

        <form method="post" action="/datates-prosestambah" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Nama Klien<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="namaklien" id="namaklien"
                                value="{{ old('namaklien') }}" />
                            <span style="color:red">
                                @error('namaklien')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <a class="text-dark">Kategori Tes<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="kategorites" id="kategorites"
                                value="{{ old('kategorites') }}" />
                            <span style="color:red">
                                @error('kategorites')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Tipe Pengguna<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="tipepengguna" id="tipepengguna"
                                value="{{ old('tipepengguna') }}" />
                            <span style="color:red">
                                @error('tipepengguna')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <a class="text-dark">Tanggal Ujian<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="date" name="tanggalujian" id="tanggalujian"
                                value="{{ old('tanggalujian') }}" />
                            <span style="color:red">
                                @error('tanggalujian')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Tujuan Ujian<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="tujuanujian" id="tujuanujian"
                                value="{{ old('tujuanujian') }}" />
                            <span style="color:red">
                                @error('tujuanujian')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-actions float-right">
                        <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                                class="fa fa-times"></i> Batal</button>
                        <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" title="Save"><i
                                class="fa fa-check"></i> Simpan</button>
                    </div>
                </div>
            </div>
    </div>
    </form>
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
