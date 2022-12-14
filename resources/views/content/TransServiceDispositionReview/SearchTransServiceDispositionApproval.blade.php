@inject('TransServiceDispositionApproval', 'App\Http\Controllers\TransServiceDispositionApprovalController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('trans-service-disposition-review') }}">Daftar IQ Norma</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Tambah IQ Norma</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    <b>Form</b> <small>Tambah IQ Norma</small>
</h3>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif 
<div class="card border border-dark">
    <div class="card-header bg-dark clearfix">
        <h5 class="mb-0 float-left">
            Form Tambah IQ Norma 
        </h5>
        <div class="form-actions float-right">
            <button onclick="location.href='{{ url('trans-service-disposition-review') }}'" name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form method="post" action="/system-user/process-add-system-user" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Norma IQ SW Mulai<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="name" id="name" value=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Norma IQ SW Akhir<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="full_name" id="full_name" value=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Nilai IQ Norma<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="password" name="password" id="password" value=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Persentase IQ Norma</a>
                        <input class="form-control input-bb" type="text" name="phone_number" id="phone_number" value=""/>
                    </div>
                </div>
                <div class="card-footer text-muted">
                        <div class="form-actions float-right">
                        <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
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