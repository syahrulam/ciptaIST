@inject('TransServiceDispositionReview', 'App\Http\Controllers\TransServiceDispositionReviewController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar IQ Norma</li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Norma IQ</b> <small>Mengelola Norma IQ</small>
    </h3>
    <br />
    <div id="accordion">
        <form method="post" action="{{ route('filter-service-disposition-review') }}" enctype="multipart/form-data">
            @csrf
            <div class="card border border-dark">
                <div class="card-header bg-dark clearfix">
                    <h5 class="mb-0 float-left">
                        Daftar
                    </h5>
                    <div class="form-actions float-right">
                        <button onclick="location.href='{{ url('trans-service-disposition-review/search') }}'"
                            name="Find" class="btn btn-sm btn-info" title="Add Data"><i class="fa fa-plus"></i>
                            Tambah IQ Norma Baru</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" style="width:100%"
                            class="table table-striped table-bordered table-hover table-full-width">
                            <thead>
                                <tr>
                                    <th width="10%" style='text-align:center'>No</th>
                                    <th width="10%" style='text-align:center'>IQ SW Mulai</th>
                                    <th width="10%" style='text-align:center'>IQ SW Akhir</th>
                                    <th width="10%" style='text-align:center'>Nilai IQ</th>
                                    <th width="10%" style='text-align:center'>Persentase IQ</th>
                                    <th width="10%" style='text-align:center'>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($transservicedisposition as $service)
                                    <tr>
                                        <td style='text-align:center'>{{ $no }}</td>
                                        <td>{{ $service['service_requisition_no'] }}</td>
                                        <td>{{ $service['created_at'] }}</td>
                                        <td>{{ $service['service_requisition_name'] }}</td>
                                        <td>{{ $TransServiceDispositionReview->getServiceName($service['service_id']) }}
                                        </td>
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
