@inject('TransServiceRequisition', 'App\Http\Controllers\IstPreferensi\IstController')

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
        <b>IST</b> <small>Mengelola IST</small>
    </h3>
    <br />
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('ist-tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah IST Baru</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="table-ist" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="10%" style='text-align:center'>No</th>
                            <th width="15%" style='text-align:center'>Kode IST</th>
                            <th width="15%" style='text-align:center'>Nama IST</th>
                            <th width="5%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="listIst">
                        @foreach ($getIst as $a)
                            <tr>
                                <td>{{ $a->ID_ist }}</td>
                                <td>{{ $a->kodeIst }}</td>
                                <td>{{ $a->namaIst }}</td>
                                <td>
                                    <li class="btn btn-outline-info btn-sm"
                                        onClick="location.href='{{ route('halaman-edit-ist') }}'">
                                        Edit</li>
                                    <li class="btn btn-outline-danger btn-sm" onClick="location.href='{{ route('ist') }}'">
                                        Hapus</li>
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
