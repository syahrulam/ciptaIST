@inject('TransServiceRequisition', 'App\Http\Controllers\TesPreferensi\TesPreferensiController')

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
            <li class="breadcrumb-item active" aria-current="page">Pertanyaan</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Daftar Pertanyaan</b> <small>Mengelola Pertanyaan</small>
    </h3>
    <br />
    <div id="accordion">
        <form method="post" action="{{ route('pertanyaan') }}" enctype="multipart/form-data">
            @csrf
            <div class="card border border-dark">
                <div class="card-header bg-dark" id="headingOne" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <h5 class="mb-0">
                        Filter
                    </h5>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <form action="/pertanyaan/cari-pertanyaan" method="GET">
                                        <div class="form-group col-8">
                                            <label class="col-sm-2 col-form-label">Kode IST</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select choose" name="cari">
                                                    <option value=""> -- Pilih Kode IST -- </option>
                                                    @foreach ($categories as $c)
                                                        <option value="{{ $c->name }}"> {{ $c->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-actions float-right">
                                            <button type="reset" name="reset" class="btn btn-danger"
                                                onClick="window.location.reload();"><i class="fa fa-times"></i>
                                                Batal</button>
                                            <button type="submit" name="cari" class="btn btn-primary"
                                                title="Search Data"><i class="fa fa-search"></i> Cari</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
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
                <button onclick="location.href='{{ url('tambah-pertanyaan') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah
                    Pertanyaan</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="1%" style='text-align:center'>No</th>
                            <th width="5%" style='text-align:center'>Kode IST</th>
                            <th width="15%" style='text-align:center'>Nomor Pertanyaan</th>
                            <th width="15%" style='text-align:center'>Komentar Pertanyaan</th>
                            <th width="10%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="listPertanyaan">
                        @foreach ($categories as $a)
                            @foreach ($questions as $b)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $a->name }}</td>
                                    <td>{{ $b->id }}</td>
                                    <td>{{ $b->comment }}</td>
                                    <td>
                                        <a href="{{ $b->id }}/detail-pertanyaan"
                                            class="btn btn-outline-info btn-sm">Detail</a>
                                        <a href="/pertanyaan/{{ $b->id }}/edit-pertanyaan"
                                            class="btn btn-outline-warning btn-sm">Edit</a>
                                        <a href="/pertanyaan/{{ $b->id }}/hapus-pertanyaan"
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
