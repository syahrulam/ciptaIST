@inject('TransServiceRequisition', 'App\Http\Controllers\IstPreferensi\IstilahIqController')

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
            <li class="breadcrumb-item active" aria-current="page">Istilah IQ</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Istilah IQ</b> <small>Mengelola Istilah IQ</small>
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
                <button onclick="location.href='{{ url('istilah-iq-tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah
                    Istilah IQ</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="1%" style='text-align:center'>No</th>
                            <th width="10%" style='text-align:center'>IQ SW Mulai</th>
                            <th width="10%" style='text-align:center'>IQ SW Akhir</th>
                            <th width="15%" style='text-align:center'>Nilai IQ</th>
                            <th width="15%" style='text-align:center'>Presentasi IQ</th>
                            <th width="10%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="listPertanyaan">
                        @foreach ($core_norm_iq as $a)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->norm_iq_sw_start }}</td>
                                <td>{{ $a->norm_iq_sw_end }}</td>
                                <td>{{ $a->norm_iq_value }}</td>
                                <td>{{ $a->norm_iq_percentage }}</td>
                                <td>
                                    <a href="/istilah-iq/{{ $a->norm_iq_id }}/edit-istilah-iq"
                                        class="btn btn-outline-warning btn-sm">Edit</a>
                                    <a href="/istilah-iq/{{ $a->norm_iq_id }}/hapus-istilah-iq"
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
