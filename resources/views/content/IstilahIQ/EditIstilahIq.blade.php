@inject('TransServiceRequisition', 'App\Http\Controllers\IstPreferensi\IstilahIqController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('istilah-iq') }}">Istilah IQ List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Istilah IQ</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Istilah Iq</b> <small>Kelola Istilah Iq</small>
    </h3>
    <br />
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Halaman Edit
            </h5>
            <div class="form-actions float-right">
                <li class="btn btn-outline-warning btn-sm" onClick="location.href='{{ route('istilah-iq') }}'">
                    Kembali</li>
            </div>
        </div>

        <div class="card-body">
            @foreach ($core_norm_iq as $p)
                <form action="/istilah-iq/{id}/edit-istilah-iqproses" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $p->norm_iq_id }}"> <br />
                    <div class="form-group">
                        <label for="edukasi">IQ Total Mulai</label>
                        <input type="text" required="required" class="form-control" name="namaedukasi"
                            value="{{ $p->norm_iq_sw_start }}">
                    </div>
                    <div class="form-group">
                        <label for="edukasi">IQ Total Akhir</label>
                        <input type="text" required="required" class="form-control" name="namaedukasi"
                            value="{{ $p->norm_iq_sw_end }}">
                    </div>
                    <div class="form-group">
                        <label for="edukasi">Nilai IQ</label>
                        <input type="text" required="required" class="form-control" name="namaedukasi"
                            value="{{ $p->norm_iq_value }}">
                    </div>
                    <div class="form-group">
                        <label for="edukasi">Presentasi IQ</label>
                        <input type="text" required="required" class="form-control" name="namaedukasi"
                            value="{{ $p->norm_iq_percentage }}">
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
