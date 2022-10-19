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
                Detail Pertanyaan
            </h5>
            <div class="form-actions float-right">
                <li class="btn btn-outline-warning btn-sm" onClick="location.href='{{ route('pertanyaan') }}'">
                    Kembali</li>
            </div>
        </div>

        <div class="card-body">
            @foreach ($core_ist as $p)
                {{-- @foreach ($core_question as $q) --}}
                <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $p->ist_id }}"> <br />
                    <div class="form-group">
                        <label for="kodeIst">Kode IST</label>
                        <input type="text" required="required" class="form-control" name="kodeist"
                            value="{{ $p->ist_code }}">
                    </div>
                    <div class="form-group">
                        <label for="noPertanyaan">Nomor Pertanyaan</label>
                        <input type="text" required="required" class="form-control" name="nopertanyaan"
                            value="{{ $p->question_no }}">
                    </div>
                    <div class="form-group">
                        <label for="KomenPertanyaan">Komentar Pertanyaan</label>
                        <input type="text" required="required" class="form-control" name="komenpertanyaan"
                            value="{{ $p->question_remark }}">
                    </div>
                    <div class="form-group">
                        <label for="Pertanyaan">Pertanyaan</label>
                        <input type="text" required="required" class="form-control" name="pertanyaan"
                            value="{{ $p->question_title }}">
                    </div>
                    {{-- @endforeach --}}
            @endforeach
        </div>
    </div>
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Jawaban
            </h5>
        </div>

        <div class="card-body">
            {{-- @foreach ($core_question_answer as $a) --}}
            <div class="table-responsive">
                <table id="table-ist" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="mt-radio mt-radio-outline">
                                <input type="radio" class="radio" name="a" id="a" value="">
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="mt-radio mt-radio-outline">
                                <input type="radio" class="radio" name="b" id="b" value="">
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="mt-radio mt-radio-outline">
                                <input type="radio" class="radio" name="c" id="c" value="">
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="mt-radio mt-radio-outline">
                                <input type="radio" class="radio" name="d" id="d" value="">
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="mt-radio mt-radio-outline">
                                <input type="radio" class="radio" name="e" id="e" value="">
                                <span></span>
                            </label>
                        </div>
                    </div>
            </div>
            {{-- @endforeach --}}
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
