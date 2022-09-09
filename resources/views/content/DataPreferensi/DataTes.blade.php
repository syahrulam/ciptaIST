@inject('TransServiceRequisition', 'App\Http\Controllers\TransServiceRequisitionController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

@section('content')
    <br>
    <h3 class="page-title">
        <b>Data Test</b> <small>Peserta</small>
    </h3>
    <br>
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Data Tes
            </h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="table-2" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="10%" style='text-align:center'>ID</th>
                            <th width="15%" style='text-align:center'>Nama Pesan</th>
                            <th width="15%" style='text-align:center'>Isi Pesan</th>
                        </tr>
                    </thead>
                    <tbody id="datates">
                        @foreach ($getMessages as $a)
                            <tr>
                                <td>{{ $a->messages_id }}</td>
                                <td>{{ $a->messages_name }}</td>
                                <td>{{ $a->messages_text }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $('#datates').html(html);
        $('#table-2').DataTable();
    </script>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
