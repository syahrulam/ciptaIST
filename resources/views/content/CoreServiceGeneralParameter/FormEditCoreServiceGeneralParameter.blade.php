@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')    
@section('js')
<script>
	function reset_edit(){
		$.ajax({
				type: "GET",
				url : "{{route('edit-reset-service', ['service_id' => $coreservicegeneralparameter['service_general_parameter_id']])}}",
				success: function(msg){
                    location.reload();
			}

		});
	}
</script>
@stop

@section('content_header')


    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('inv-item') }}">Daftar Surat Umum</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Surat Umum</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    Form Edit Surat Umum
</h3>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif
    <form method="post" action="{{route('process-edit-service-general-parameter')}}" enctype="multipart/form-data">

        <div class="card border border-dark">
            <div class="card-header border-dark bg-dark">
                <h5 class="mb-0 float-left">
                    Form Edit
                </h5>
                <div class="float-right">
                    <a onclick="location.href='{{ route('service-general-parameter') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</a>
                </div>
            </div>

            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Nomor Surat Umum<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="service_general_parameter_no" id="service_general_parameter_no" value="{{$coreservicegeneralparameter['service_general_parameter_no']}}" autocomplete="off"/>

                            <input class="form-control input-bb" type="hidden" name="service_general_parameter_id" id="service_general_parameter_id" value="{{$coreservicegeneralparameter['service_general_parameter_id']}}"/>

                            <input class="form-control input-bb" type="hidden" name="service_general_parameter_token_edit" id="service_general_parameter_token_edit" value="{{$service_general_token_edit}}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Nama Surat Umum<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="service_general_parameter_name" id="service_general_parameter_name" value="{{$coreservicegeneralparameter['service_general_parameter_name']}}" autocomplete="off"/>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="reset_edit();"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
                </div>
            </div>
        </div>
    </form>
    <br>
    <br>
    <br>
@stop

@section('footer')
    
@stop

@section('css')
    
@stop