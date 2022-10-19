@inject('TransServiceRequisition', 'App\Http\Controllers\IstPreferensi\GesamtIstController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('gesamt') }}">Gesamt</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Gesamt</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Tambah Gesamt</b> <small>Mengelola Gesamt</small>
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
                Form Tambah Gesamt
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('gesamt') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        @if (Session::get('Success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::get('Fail'))
            <div class="alert alert-danger">
                {{ Session::get('Fail') }}
            </div>
        @endif

        <form method="post" action="istilah-ge-prosestambah" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Total Gesamt Mulai<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="totalgesamtmulai"
                                id="totalgesamtmulai" value="{{ old('totalgesamtmulai') }}" />
                            <span style="color:red">
                                @error('totalgesamtmulai')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Total Gesamt Akhir<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="totalgesamtakhir"
                                id="totalgesamtakhir" value="{{ old('totalgesamtakhir') }}" />
                            <span style="color:red">
                                @error('totalgesamtakhir')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Nilai Gesamt Total RW Mulai<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="nilaigesamtmulairw"
                                id="nilaigesamtmulairw" value="{{ old('nilaigesamtmulairw') }}" />
                            <span style="color:red">
                                @error('nilaigesamtmulairw')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Nilai Gesamt Total RW Akhir<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="nilaigesamtakhirrw"
                                id="nilaigesamtakhirrw" value="{{ old('nilaigesamtakhirrw') }}" />
                            <span style="color:red">
                                @error('nilaigesamtakhirrw')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Gesamt Total SW<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="nilaigesamtsw" id="nilaigesamtsw"
                                value="{{ old('nilaigesamtsw') }}" />
                            <span style="color:red">
                                @error('nilaigesamtsw')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-actions float-right">
                            <button type="reset" name="Reset" class="btn btn-danger"
                                onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                            <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" title="Save"><i
                                    class="fa fa-check"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- @section('scripts')
        <script>
            $(document).on('click', '#btnSubmit', function(e) {
                var kodeIst = $('#kodeIst').val();
                var namaIst = $('#namaIst').val();
                var durasiIst = $('#durasiIst').val();
                var deskripsiIst = $('#deskripsiIst').val();

                var data = {}
                data.kodeIst = kodeIst;
                data.namaIst = namaIst;
                data.durasiIst = durasiIst;
                data.deskripsiIst = deskripsiIst;

                route = "{{ route('ist-prosestambah') }}";

                $.ajax({
                    url: route,
                    type: "POST",
                    data: "datanya=" + JSON.stringify(data),
                    dataType: "json",
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            swal.fire("Success!", data.message, data.alert)
                                .then(function() {
                                    location.href = "{{ route('ist') }}"
                                });
                        } else {
                            swal.fire("Warning!", data.message, data.alert);
                        }
                    },
                    error: function(data) {
                        swal.fire("Error!", "Add failed!", "error");
                    }
                })
            })
        </script>
    @endsection --}}
    @stop

    @section('footer')

    @stop

    @section('css')

    @stop

    @section('js')

    @stop