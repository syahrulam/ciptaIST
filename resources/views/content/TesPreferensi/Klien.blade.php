@inject('TransServiceRequisition', 'App\Http\Controllers\TesPreferensi\TesPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')



@stop

@section('content')

    <h3 class="page-title">
        <b>Kategori Klien</b> <small>Mengelola Klien</small>
    </h3>
    <br />
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('klien-tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Klien</button>
            </div>
        </div>

        <div class="card-body">
            <div class="form-actions float-right">
                <form action="/klien/cari-klien" method="GET">
                    <input type="text" name="cari" placeholder="Nama Klien" value="{{ old('cari') }}">
                    <input type="submit" value="CARI">
                </form><br>
            </div>
            <div class="table-responsive">
                <table id="table-ist" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="10%" style='text-align:center'>No</th>
                            <th width="15%" style='text-align:center'>Nama Klien</th>
                            <th width="15%" style='text-align:center'>Nomor Telfon Klien 1</th>
                            <th width="15%" style='text-align:center'>Nomor Telfon Klien 2</th>
                            <th width="15%" style='text-align:center'>Nomor Telfon Rumah Klien</th>
                            <th width="15%" style='text-align:center'>Nama Yang Dapat Dihubungi</th>
                            <th width="10%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="listKlien">
                        @foreach ($tb_klien as $a)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->namaklien }}</td>
                                <td>{{ $a->nomorklien }}</td>
                                <td>{{ $a->nomorkliendua }}</td>
                                <td>{{ $a->nomorrumah }}</td>
                                <td>{{ $a->kontakperson }}</td>
                                <td>
                                    <a href="/klien/{{ $a->id }}/edit-klien/"
                                        class="btn btn-outline-warning btn-sm">Edit</a>
                                    <a href="/klien/{{ $a->id }}/hapus-klien/"
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
        $('#listKlien').html(html);
        $('#table-ist').DataTable();
    </script>
@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
