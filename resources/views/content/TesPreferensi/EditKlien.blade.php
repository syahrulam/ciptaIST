@inject('TransServiceRequisition', 'App\Http\Controllers\TesPreferensi\TesPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Klien</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Klien</b> <small>Kelola Klien</small>
    </h3>
    <br />
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Halaman Edit
            </h5>
            <div class="form-actions float-right">
                <li class="btn btn-outline-warning btn-sm" onClick="location.href='{{ route('klien') }}'">
                    Kembali</li>
            </div>
        </div>

        <div class="card-body">
            @foreach ($core_client as $p)
                <form action="/klien/{id}/edit-klienproses" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $p->client_id }}"> <br />
                    <div class="form-group">
                        <label for="klien">Nama Klien</label>
                        <input type="text" required="required" class="form-control" name="namaklien"
                            value="{{ $p->client_name }}">
                    </div>
                    <div class="form-group">
                        <label for="klien">Nomor Telfon Klien 1</label>
                        <input type="text" required="required" class="form-control" name="nomorklien"
                            value="{{ $p->client_mobile_phone1 }}">
                    </div>
                    <div class="form-group">
                        <label for="klien">Nomor Telfon Klien 2</label>
                        <input type="text" required="required" class="form-control" name="nomorkliendua"
                            value="{{ $p->client_mobile_phone2 }}">
                    </div>
                    <div class="form-group">
                        <label for="klien">Nomor Telfon Rumah Klien</label>
                        <input type="text" required="required" class="form-control" name="nomorrumah"
                            value="{{ $p->client_home_phone }}">
                    </div>
                    <div class="form-group">
                        <label for="klien">Nama Yang Dapat Dihubungi</label>
                        <input type="text" required="required" class="form-control" name="kontakperson"
                            value="{{ $p->client_contact_person }}">
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
