@inject('TransServiceRequisition', 'App\Http\Controllers\TesPreferensi\TesPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

@stop

@section('content')

    <h3 class="page-title"><br>
        <small>Pertanyaan Komentar</small>
    </h3>
    <br>
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Edit Pertanyaan
            </h5>
            <div class="form-actions float-right">
                <li class="btn btn-outline-warning btn-sm" onClick="location.href='{{ route('pertanyaan') }}'">
                    Kembali</li>
            </div>
        </div>

        <div class="card-body">
            @foreach ($tb_pertanyaan as $p)
                <form action="/pertanyaan/{id}/edit-pertanyaanproses" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $p->id }}"> <br />
                    <div class="form-group">
                        <label for="kodeIst">Kode IST</label>
                        <input type="text" required="required" class="form-control" name="kodeist"
                            value="{{ $p->kodeIST }}">
                    </div>
                    <div class="form-group">
                        <label for="noPertanyaan">Nomor Pertanyaan</label>
                        <input type="text" required="required" class="form-control" name="nopertanyaan"
                            value="{{ $p->nomorPertanyaan }}">
                    </div>
                    <div class="form-group">
                        <label for="KomenPertanyaan">Komentar Pertanyaan</label>
                        <input type="text" required="required" class="form-control" name="komenpertanyaan"
                            value="{{ $p->komentarPertanyaan }}">
                    </div>
                    <div class="form-group">
                        <label for="Pertanyaan">Pertanyaan</label>
                        <input type="text" required="required" class="form-control" name="pertanyaan"
                            value="{{ $p->pertanyaan }}">
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
    {{-- <script>
        $(document).on('click', '#save', function(e) {
            var kodeist = $('#kodeist').val();
            var nopertanyaan = $('#nopertanyaan').val();
            var pertanyaan = $('#pertanyaan').val();

            var data = {}
            data.kodeist = kodeist;
            data.nopertanyaan = nopertanyaan;
            data.pertanyaan = pertanyaan;

            console.log(data);

            route = "{{ url('edit-pertanyaan-proses) }}";

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
                                location.href = "{{ route('editPertanyaan') }}"
                            });
                    } else {
                        swal.fire("Warning!", data.message, data.alert);
                    }
                },
                error: function(data) {
                    swal.fire("Error!", "Edit Gagal!", "error");
                }
            })
        })
    </script> --}}
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
