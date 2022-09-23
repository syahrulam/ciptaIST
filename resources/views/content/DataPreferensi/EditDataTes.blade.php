@inject('TransServiceRequisition', 'App\Http\Controllers\DataPreferensi\DataPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Tes</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Data Tes</b> <small>Kelola Data Tes</small>
    </h3>
    <br />
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Halaman Edit
            </h5>
            <div class="form-actions float-right">
                <li class="btn btn-outline-warning btn-sm" onClick="location.href='{{ route('datates') }}'">
                    Kembali</li>
            </div>
        </div>

        <div class="card-body">
            @foreach ($tb_datates as $p)
                <form action="/datates/{id}/edit-datatesproses" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $p->id }}"> <br />
                    <div class="form-group">
                        <label for="edukasi">Nama Klien</label>
                        <input type="text" required="required" class="form-control" name="namaklien"
                            value="{{ $p->namaklien }}">
                    </div>
                    <div class="form-group">
                        <label for="edukasi">Kategori Tes</label>
                        <input type="text" required="required" class="form-control" name="kategorites"
                            value="{{ $p->kategorites }}">
                    </div>
                    <div class="form-group">
                        <label for="edukasi">Tipe Pengguna</label>
                        <input type="text" required="required" class="form-control" name="tipepengguna"
                            value="{{ $p->tipepengguna }}">
                    </div>
                    <div class="form-group">
                        <label for="edukasi">Tanggal Ujian</label>
                        <input type="date" required="required" class="form-control" name="tanggalujian"
                            value="{{ $p->tanggalujian }}">
                    </div>
                    <div class="form-group">
                        <label for="edukasi">Tujuan Ujian</label>
                        <input type="text" required="required" class="form-control" name="tujuanujian"
                            value="{{ $p->tujuanujian }}">
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
        $('#listdatates').html(html);
        $('#table-ist').DataTable();
    </script>
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
