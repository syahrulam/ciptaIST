@inject('TransServiceRequisition', 'App\Http\Controllers\IstPreferensi\IstilahIstController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('istilah-ist') }}">Istilah IST List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Istilah IST</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Tambah IST</b> <small>Mengelola IST</small>
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
                Form Tambah IST
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('istilah-ist') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Back"><i class="fa fa-angle-left"></i> Kembali</button>
            </div>
        </div>

        <form method="post" action="/system-user/process-add-system-user" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Kode IST<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="kodeist" id="kodeIst"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Usia Norma IST Dimulai<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="UsiaNormaMulai" id="UsiaNormaMulai"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Usia Norma IST Berakhir<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="UsiaNormaAkhir" id="UsiaNormaAkhir"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">IST RW<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="ISTRw" id="ISTRw"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">IST SW<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="ISTSw" id="ISTSw"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Norma IST Total Mulai<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="NormaISTMulai" id="NormaISTMulai"
                                value="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Norma IST Total Akhir<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="NormaISTAkhir" id="NormaISTAkhir"
                                value="" />
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
    @section('scripts')
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
    @endsection
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
