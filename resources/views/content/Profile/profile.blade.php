@inject('TransServiceRequisition', 'App\Http\Controllers\DataPreferensi\DataPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        </ol>
    </nav>

@stop

@section('content')

    <h3 class="page-title">
        <b>Profile</b>
    </h3>
    <br />
    <div class="card border border-dark">
        <div class="card-body">
            @foreach ($userr as $p)
                <form action="/datates/{id}/edit-datatesproses" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" required="required" class="form-control" name="name"
                            value="{{ $p->name }}" readonly>
                    </div>
            @endforeach
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
