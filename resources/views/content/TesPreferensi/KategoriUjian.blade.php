@inject('TransServiceRequisition', 'App\Http\Controllers\TesPreferensi\TesPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')



@stop

@section('content')

    <h3 class="page-title">
        <b>Kategori Ujian</b> <small>Mengelola Kategori Ujian</small>
    </h3>
    <br />
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('kategori-tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Kategori Ujian</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="table-ist" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="10%" style='text-align:center'>No</th>
                            <th width="15%" style='text-align:center'>Nama Kategori</th>
                            <th width="5%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="listCat">
                        @foreach ($tb_kategori as $a)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->namakategori }}</td>
                                <td>
                                    <a href="/kategori/{{ $a->id }}/edit-kategori"
                                        class="btn btn-outline-warning btn-sm">Edit</a>
                                    <a href="/kategori/{{ $a->id }}/hapus-kategori"
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
        $('#listCat').html(html);
        $('#table-ist').DataTable();
    </script>
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
