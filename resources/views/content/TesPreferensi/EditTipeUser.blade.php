@inject('TransServiceRequisition', 'App\Http\Controllers\TesPreferensi\TesPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">IST List</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Tipe User</b> <small>Kelola Tipe User</small>
    </h3>
    <br />
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Halaman Edit
            </h5>
            <div class="form-actions float-right">
                <li class="btn btn-outline-warning btn-sm" onClick="location.href='{{ route('user') }}'">
                    Kembali</li>
            </div>
        </div>
        <div class="col-md-12"><br>
            <label>User Type Name</label><br>
            <div class="form-group form-md-line-input">
                <input type="text" class="form-control" id="user_type_name" name="user_type_name" value="HRD"
                    onchange="function_elements_edit(this.name, this.value);">
            </div><br>
            <div class="row">
                <div class="col-md-12" style="text-align  : right !important;">
                    <input type="reset" name="Reset" value="Cancel" class="btn btn-danger" onclick="reset_add();">
                    <input type="submit" name="Save" id="Save" value="Save" class="btn btn-primary"
                        title="Simpan Data">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-ist" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
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
