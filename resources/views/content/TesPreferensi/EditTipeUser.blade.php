@inject('TransServiceRequisition', 'App\Http\Controllers\TesPreferensi\TesPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">IST List</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Tipe User</b> <small>Kelola Tipe User</small>
    </h3>
    <br />
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Halaman Edit
            </h5>
            <div class="form-actions float-right">
                <li class="btn btn-outline-warning btn-sm" onClick="location.href='{{ route('user') }}'">
                    Kembali</li>
            </div>
        </div>

        <div class="card-body">
            @foreach ($system_user_group as $p)
                <form action="/user/{id}/edit-userproses" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $p->user_group_id }}"> <br />
                    <div class="form-group">
                        <label for="usertypename">Nama Tipe User</label>
                        <input type="text" required="required" class="form-control" name="namatipeuser"
                            value="{{ $p->user_group_name }}">
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="text-align  : right !important;">
                            <input type="submit" name="Save" id="save" value="Simpan Data" class="btn btn-primary"
                                title="Simpan Data">
                        </div>
                    </div>
            @endforeach
        </div>
    </div>


    <script>
        $('#listIst').html(html);
        $('#table-ist').DataTable();
    </script>
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
