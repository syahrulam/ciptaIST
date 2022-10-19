@inject('TransServiceRequisition', 'App\Http\Controllers\IstPreferensi\GesamtIstController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('js')
    {{-- <script>
        $(document).ready(function() {
            var section_id = {!! json_encode($section_id) !!};
            var service_id = {!! json_encode($service_id) !!};

            if (section_id == null) {
                $("#section_id").select2("val", "0");
            }
            if (service_id == null) {
                $("#service_id").select2("val", "0");
            }
        });
    </script> --}}
@stop

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gesamt</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Gesamt</b> <small>Mengelola Gesamt</small>
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
                <button onclick="location.href='{{ url('gesamt-tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Gesamt</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="1%" style='text-align:center'>No</th>
                            <th width="10%" style='text-align:center'>Gesamt Usia Mulai</th>
                            <th width="10%" style='text-align:center'>Gesamt Usia Akhir</th>
                            <th width="15%" style='text-align:center'>Gesamt Total RW Mulai</th>
                            <th width="15%" style='text-align:center'>Gesamt Total RW Akhir</th>
                            <th width="15%" style='text-align:center'>Gesamt Total SW</th>
                            {{-- <th width="10%" style='text-align:center'>Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody id="listPertanyaan">
                        @foreach ($gesamt_data as $a)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->gesamt_age_start }}</td>
                                <td>{{ $a->gesamt_age_end }}</td>
                                <td>{{ $a->gesamt_total_rw_start }}</td>
                                <td>{{ $a->gesamt_total_rw_end }}</td>
                                <td>{{ $a->gesamt_total_sw }}</td>
                                {{-- <td>
                                    <a href="/istilah-ge/{{ $a->norm_ge_id }}/edit-istilah-ge"
                                        class="btn btn-outline-warning btn-sm">Edit</a>
                                    <a href="/istilah-ge/{{ $a->norm_ge_id }}/hapus-istilah-ge"
                                        class="btn btn-outline-danger btn-sm">Hapus</a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <script>
        $('#listPertanyaan').html(html);
        $('#table-ist').DataTable();
    </script>
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
