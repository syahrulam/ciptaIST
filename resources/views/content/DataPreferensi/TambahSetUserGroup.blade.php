@inject('TransServiceRequisition', 'App\Http\Controllers\DataPreferensi\DataPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')


@stop

@section('content')

    <h3 class="page-title">
        <b>Tambah User Group</b> <small>Mengelola User Group</small>
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
                Form Tambah User Group
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('setusergroup') }}'" name="Find" class="btn btn-sm btn-info"
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

        <form method="post" action="/setusergroup-prosestambah" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Tingkatan<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="tingkatan" id="tingkatan"
                                value="{{ old('tingkatan') }}" />
                            <span style="color:red">
                                @error('tingkatan')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <a class="text-dark">Nama<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="nama" id="nama"
                                value="{{ old('nama') }}" />
                            <span style="color:red">
                                @error('nama')
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
