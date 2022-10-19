@inject('TransServiceRequisition', 'App\Http\Controllers\TesPreferensi\TesPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('js')

@stop

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
        <b>Daftar Klien</b> <small>Mengelola Klien</small>
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
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('klien-tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah
                    Klien</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="10%" style='text-align:center'>No</th>
                            <th width="15%" style='text-align:center'>Nama Klien</th>
                            <th width="15%" style='text-align:center'>Nomor Telfon Klien 1</th>
                            <th width="15%" style='text-align:center'>Nomor Telfon Klien 2</th>
                            <th width="15%" style='text-align:center'>Nomor Telfon Rumah Klien</th>
                            <th width="15%" style='text-align:center'>Nama Yang Dapat Dihubungi</th>
                            <th width="10%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="listKlien">
                        @foreach ($core_client as $a)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->client_name }}</td>
                                <td>{{ $a->client_mobile_phone1 }}</td>
                                <td>{{ $a->client_mobile_phone2 }}</td>
                                <td>{{ $a->client_home_phone }}</td>
                                <td>{{ $a->client_contact_person }}</td>
                                <td>
                                    <a href="/klien/{{ $a->client_id }}/edit-klien/"
                                        class="btn btn-outline-warning btn-sm">Edit</a>
                                    <a href="/klien/{{ $a->client_id }}/hapus-klien/"
                                        class="btn btn-outline-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <script>
        $('#listKlien').html(html);
        $('#table-ist').DataTable();
    </script>
@stop

@section('footer')

@stop

@section('css')

@stop
