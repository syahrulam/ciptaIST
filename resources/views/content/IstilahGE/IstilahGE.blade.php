@inject('TransServiceRequisition', 'App\Http\Controllers\IstPreferensi\IstilahGeController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Istilah GE List</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>IST</b> <small>Mengelola IST</small>
    </h3>
    <br>
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('istilah-ge-tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah IST Baru</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="table-ist" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="5%" style='text-align:center'>GE Total Mulai</th>
                            <th width="10%" style='text-align:center'>GE Total Akhir</th>
                            <th width="10%" style='text-align:center'>Nilai GE</th>
                            <th width="10%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>tes</td>
                        <td>tes</td>
                        <td>tes</td>
                        <td>
                            <li class="btn btn-outline-info btn-sm"
                                onClick="location.href='{{ route('halaman-edit-istilah-ge') }}'">
                                Edit</li>
                            <li class="btn btn-outline-danger btn-sm" onClick="location.href='{{ route('ist') }}'">
                                Hapus</li>
                        </td>
                        {{-- @foreach ($getIst as $a)
                            <tr>
                                <td>{{ $a->ID_ist }}</td>
                                <td>{{ $a->kodeIst }}</td>
                                <td>{{ $a->namaIst }}</td>
                                <td>
                                    <a href="#" class="btn default btn-xs purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="#"
                                        onclick="javascript:return confirm(&quot;Are you sure you want to delete this entry ?&quot;)"
                                        class="btn default btn-xs red">
                                        <i class="fa fa-trash-o"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
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
