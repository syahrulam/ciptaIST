@inject('TransServiceDispositionApproval', 'App\Http\Controllers\TransServiceDispositionApprovalController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('trans-service-disposition-approval') }}">Daftar Norma GE</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Daftar Norma GE</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Form</b> <small>Tambah Daftar Norma GE</small>
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
                Form Tambah Norma GE
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('system-user') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="post" action="/system-user/process-add-system-user" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">GE Total Mulai<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="mulai" id="GEmulai"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">GE Total Akhir<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="akhir" id="GEakhir"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Nilai GE<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="nilaiGE" id="nilaiGE"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-actions float-right">
                                <button type="reset" name="Reset" class="btn btn-danger"
                                    onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                                <button type="submit" name="Save" class="btn btn-primary" title="Save"><i
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
