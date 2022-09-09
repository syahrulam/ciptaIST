@inject('TransServiceRequisition', 'App\Http\Controllers\TesPreferensi\TesPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

@stop

@section('content')

    <h3 class="page-title"><br>
        <b>Daftar Pertanyaan</b> <small>Kelola Pertanyaan</small>
    </h3>
    <br />
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
                        @foreach ($getPertanyaan as $a)
                            <tr>
                                <td>{{ $a->ID }}</td>
                                <td>{{ $a->kodeIST }}</td>
                                <td>{{ $a->nomorPertanyaan }}</td>
                                <td>{{ $a->komentarPertanyaan }}</td>
                                <td>
                                    <a href="{{ $a->ID }}/detail-pertanyaan"
                                        class="btn btn-outline-info btn-sm">Detail</a>
                                    {{-- <a type="button" id="btnDetail" href="{{ url('detail-pertanyaan') }}"
                                        class="btn btn-outline-info btn-sm">Detail</a>

                                    <a type="button" id="btnEdit" href="{{ url('edit-pertanyaan') }}"
                                        class="btn btn-outline-warning btn-sm">Edit</a> --}}

                                    <a type="button" class="btn btn-outline-danger btn-sm" href="#">Hapus</a>
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
