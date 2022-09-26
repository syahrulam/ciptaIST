@inject('TransServiceRequisition', 'App\Http\Controllers\DataPreferensi\DataPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')



@stop

@section('content')

    <h3 class="page-title"><br>
        <b>User Group</b> <small>Kelola User Group</small>
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
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('system-user-group/add') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah User Group</button>
            </div>
        </div>

        <div class="card-body">
            <div class="form-actions float-right">
                <form action="/setusergroup/cari-setusergroup" method="GET">
                    <input type="text" name="cari" placeholder="Nama" value="{{ old('cari') }}">
                    <input type="submit" value="CARI">
                </form><br>
            </div>
            <div class="table-responsive">
                <table id="table-ist" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="1%" style='text-align:center'>No</th>
                            <th width="15%" style='text-align:center'>Tingkatan</th>
                            <th width="15%" style='text-align:center'>Nama</th>
                            <th width="10%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="listdatates">
                        @foreach ($system_user_group as $a)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->user_group_level }}</td>
                                <td>{{ $a->user_group_name }}</td>
                                <td>

                                    <a href="/system-user-group/edit/{user_id}"
                                        class="btn btn-outline-warning btn-sm">Edit</a>
                                    <a href="/system-user-group/delete-system-user-group/{user_id}"
                                        class="btn btn-outline-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>
        $('#listdatates').html(html);
        $('#table-ist').DataTable();
    </script>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
