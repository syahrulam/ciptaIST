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
            <div class="table-responsive">
                <table id="table-ist" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <label>Kode IST</label>
                    <div class="form-group form-md-line-input">
                        <div class="input-group">
                            <select class="form-control select choose" id="pilihKodeIst">
                                <option value=""> -- Pilih Kode IST -- </option>
                            </select>
                        </div><br>
                        <label>Pertanyaan Nomor</label>
                        <input type="text" class="form-control" id="PertanyaanNomor" name="question_no"
                            value="1"><br>
                        <label>Pertanyaan</label>
                        <input type="text" class="form-control" id="question_title" name="question_title"
                            value="Pikun : Orang Tua = Ingin Tahu : ?">
                    </div>
                </table>
            </div>
        </div>
    </div>
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="table-ist" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="mt-radio mt-radio-outline">
                                <input type="radio" class="radio" name="question_answer_se_399"
                                    id="question_answer_se[399]" value="1968">a. Kepo
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="mt-radio mt-radio-outline">
                                <input type="radio" class="radio" name="question_answer_se_399"
                                    id="question_answer_se[399]" value="1969">b. Guru
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="mt-radio mt-radio-outline">
                                <input type="radio" class="radio" name="question_answer_se_399"
                                    id="question_answer_se[399]" value="1970" checked="">c. Remaja
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="mt-radio mt-radio-outline">
                                <input type="radio" class="radio" name="question_answer_se_399"
                                    id="question_answer_se[399]" value="1971">d. Laki - Laki
                                <span></span>
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="mt-radio mt-radio-outline">
                                <input type="radio" class="radio" name="question_answer_se_399"
                                    id="question_answer_se[399]" value="1972">e. Anak - Anak
                                <span></span>
                            </label>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-md-12" style="text-align  : right !important;">
                            <input type="reset" name="Reset" value="Cancel" class="btn btn-danger"
                                onclick="reset_add();">
                            <input type="submit" name="Save" id="Save" value="Save" class="btn btn-primary"
                                title="Simpan Data">
                        </div>
                    </div>
            </div>
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
