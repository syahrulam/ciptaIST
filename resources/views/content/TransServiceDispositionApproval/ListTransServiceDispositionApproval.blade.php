@inject('TransServiceDispositionApproval', 'App\Http\Controllers\TransServiceDispositionApprovalController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Norma GE List</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Norma GE</b> <small>Mengelola Norma GE</small>
    </h3>
    <br>
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('trans-service-disposition-approval/search') }}'" name="Find"
                    class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i> Tambah Norma GE Baru</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="1%" style='text-align:center'>No</th>
                            <th width="10%" style='text-align:center'>GE Total Mulai</th>
                            <th width="10%" style='text-align:center'>GE Total Akhir</th>
                            <th width="10%" style='text-align:center'>Nilai GE</th>
                            <th width="10%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- dummy --}}
                        @foreach ($transservicedisposition as $service)
                            <tr>
                                <td style='text-align:center'>{{ $no }}</td>
                                <td>{{ $service['service_disposition_id'] }}</td>
                                <td>{{ $service['service_requisition_id'] }}</td>
                                <td>{{ $service['service_disposition_status'] }}</td>
                            </tr>
                            <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
