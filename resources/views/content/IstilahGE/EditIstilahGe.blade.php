@inject('TransServiceRequisition', 'App\Http\Controllers\IstPreferensi\IstilahGeController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('istilah-ge') }}">Istilah GE List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Istilah GE</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Istilah GE</b> <small>Kelola Istilah GE</small>
    </h3>
    <br />
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Halaman Edit
            </h5>
            <div class="form-actions float-right">
                <li class="btn btn-outline-warning btn-sm" onClick="location.href='{{ route('istilah-ge') }}'">
                    Kembali</li>
            </div>
        </div>

        <div class="card-body">
            @foreach ($core_norm_ge as $p)
                <form action="/istilah-ge/{id}/edit-istilah-geproses" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $p->norm_ge_id }}"> <br />
                    <div class="form-group">
                        <label for="edukasi">GE Total Mulai</label>
                        <input type="text" required="required" class="form-control" name="namaedukasi"
                            value="{{ $p->norm_ge_total_start }}">
                    </div>
                    <div class="form-group">
                        <label for="edukasi">GE Total Akhir</label>
                        <input type="text" required="required" class="form-control" name="namaedukasi"
                            value="{{ $p->norm_ge_total_end }}">
                    </div>
                    <div class="form-group">
                        <label for="edukasi">Nilai GE</label>
                        <input type="text" required="required" class="form-control" name="namaedukasi"
                            value="{{ $p->norm_ge_value }}">
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
