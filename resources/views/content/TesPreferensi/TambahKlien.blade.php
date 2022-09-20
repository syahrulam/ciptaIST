@inject('TransServiceRequisition', 'App\Http\Controllers\TesPreferensi\TesPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')


@stop

@section('content')

    <h3 class="page-title">
        <b>Tambah Klien</b> <small>Mengelola Klien</small>
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
                Form Tambah Klien
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('klien') }}'" name="Find" class="btn btn-sm btn-info"
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

        <form method="post" action="/klien-prosestambah" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Nama Klien<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="namaklien" id="namaklien"
                                value="{{ old('namaklien') }}" />
                            <span style="color:red">
                                @error('namaklien')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <a class="text-dark">Nomor Telfon Klien 1<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="nomorklien" id="nomorklien"
                                value="{{ old('nomorklien') }}" />
                            <span style="color:red">
                                @error('nomorklien')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Nomor Telfon Klien 2<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="nomorkliendua" id="nomorkliendua"
                                value="{{ old('nomorkliendua') }}" />
                            <span style="color:red">
                                @error('nomorkliendua')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <a class="text-dark">Nomor Telfon Rumah Klien<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="nomorrumah" id="nomorrumah"
                                value="{{ old('nomorrumah') }}" />
                            <span style="color:red">
                                @error('nomorrumah')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Nama Yang Dapat Dihubungi<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="kontakperson" id="kontakperson"
                                value="{{ old('kontakperson') }}" />
                            <span style="color:red">
                                @error('kontakperson')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-actions float-right">
                        <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                                class="fa fa-times"></i> Batal</button>
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
