@inject('TransServiceRequisition', 'App\Http\Controllers\IstPreferensi\IstilahIstController')

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
            <li class="breadcrumb-item active" aria-current="page">Istilah IST</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Istilah IST</b> <small>Mengelola Istilah IST</small>
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
                <button onclick="location.href='{{ url('istilah-ist-tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah
                    Istilah IST</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="5%" style='text-align:center'>No</th>
                            <th width="10%" style='text-align:center'>Kode IST</th>
                            <th width="10%" style='text-align:center'>Usia Norma IST Dimulai</th>
                            <th width="10%" style='text-align:center'>Usia Norma IST Berakhir</th>
                            <th width="10%" style='text-align:center'>IST RW</th>
                            <th width="10%" style='text-align:center'>IST SW</th>
                            <th width="10%" style='text-align:center'>Norma IST Total Mulai</th>
                            <th width="10%" style='text-align:center'>Norma IST Total Akhir</th>
                            <th width="10%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="listPertanyaan">
                        @foreach ($core_ist as $a)
                            @foreach ($core_ist_norm as $b)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $a->ist_code }}</td>
                                    <td>{{ $b->ist_norm_age_start }}</td>
                                    <td>{{ $b->ist_norm_age_end }}</td>
                                    <td>{{ $b->ist_norm_rw }}</td>
                                    <td>{{ $b->ist_norm_sw }}</td>
                                    <td>{{ $b->ist_norm_total_start }}</td>
                                    <td>{{ $b->ist_norm_total_end }}</td>
                                    <td>
                                        <a href="/istilah-ist/{{ $b->ist_id }}/edit-istilah-ist"
                                            class="btn btn-outline-warning btn-sm">Edit</a>
                                        <a href="/istilah-ist/{{ $b->ist_id }}/hapus-istilah-ist"
                                            class="btn btn-outline-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
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
