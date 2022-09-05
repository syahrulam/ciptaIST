@inject('TransServiceRequisition', 'App\Http\Controllers\TransServiceRequisitionController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')
@section('js')
<script>

    function function_elements_add(name, value){
        console.log("name " + name);
        console.log("value " + value);
		$.ajax({
				type: "POST",
				url : "{{route('add-service-elements')}}",
				data : {
                    'name'      : name, 
                    'value'     : value,
                    '_token'    : '{{csrf_token()}}'
                },
				success: function(msg){
			}
		});
	}
</script>
@stop
@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('trans-service-requisition') }}">Daftar Pengajuan Bantuan</a></li>
        <li class="breadcrumb-item"><a href="{{ url('trans-service-requisition/search') }}">Daftar Layanan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Pengajuan Bantuan</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    Form Edit Pengajuan Bantuan
</h3>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif
    <div class="card border border-dark">
        <div class="card-header border-dark bg-dark">
            <h5 class="mb-0 float-left">
                Form Edit
            </h5>
            <div class="float-right">
                <button onclick="location.href='{{ url('trans-service-requisition') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
            </div>
        </div>

        <form method="post" action="{{route('process-edit-service-requisition')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-6">
                        <div class="form-group">
                            <a class="text-dark">Nama Layanan<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="service_name" id="service_name" value="{{$TransServiceRequisition->getServiceName($servicerequisition['service_id'])}}" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

                            <input class="form-control input-bb" type="hidden" name="service_id" id="service_id" value="{{$servicerequisition['service_id']}}" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

                            <input class="form-control input-bb" type="hidden" name="service_requisition_token_edit" id="service_requisition_token_edit" value="{{$service_requisition_token_edit}}"/>

                            <input class="form-control input-bb" type="hidden" name="service_requisition_id" id="service_requisition_id" value="{{$service_requisition_id}}"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">Nama Pemohon<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="service_requisition_name" id="service_requisition_name" value="{{$servicerequisition['service_requisition_name']}}" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <a class="text-dark">No Whatsapp Pemohon<a class='red'> *</a></a>
                            <input class="form-control input-bb" type="text" name="service_requisition_phone" id="service_requisition_phone" value="{{$servicerequisition['service_requisition_phone']}}" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
                        </div>
                    </div>
                </div>

                <br/>
                <div class="row">
                    <h5 class="form-section"><b>Syarat Dan Ketentuan</b></h5>
                </div>
                <hr style="margin:0;">
                <br/>
                <div class="table-responsive">
                    <table class="table table-bordered table-advance table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th style='text-align:center' width='5%'>No</th>
                                <th style='text-align:center' width='65%'>Deskripsi</th>
                                <th style='text-align:center' width='5%'>Status</th>
                                <th style='text-align:center' width='10%'>File Lama</th>
                                <th style='text-align:center' width='15%'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no =1;
                                foreach ($servicerequisitionterm AS $key => $val){
                                    echo"
                                        <tr>
                                            <td style='text-align  : center !important;'>".$val['service_term_no']."</td>
                                            <td style='text-align  : left !important;'>".$val['service_term_description']."</td>";?>
                                            
                                            <td style='text-align  : center'>
                                                <?php if($val['service_requisition_term_status']==1){ ?>
                                                    <input type='checkbox' class='checkboxes' name='checkbox_{{$val['service_term_id']}}' id='checkbox_{{$val['service_term_id']}}' value='1'  OnClick='checkboxSalesOrderChange({{$val['service_term_id']}})'; checked/>
                                                <?php }else{ ?>
                                                    <input type='checkbox' class='checkboxes' name='checkbox_{{$val['service_term_id']}}' id='checkbox_{{$val['service_term_id']}}' value='1'  OnClick='checkboxSalesOrderChange({{$val['service_term_id']}})';/>
                                                <?php } ?>
                                            </td>

                                            <td style='text-align  : center'>
                                                <?php if($val['service_requisition_term_value']!='' && $val['service_requisition_term_status'] == 1){ ?>
                                                    <a href='#showimage_{{$val['service_requisition_term_id']}}' data-toggle='modal' class='btn-sm btn-primary'> Open</a>   
                                                    <a href='{{url('/trans-service-requisition/download-term/'.$servicerequisition['service_id'].'/'.$val['service_requisition_term_id'])}}' class='btn-sm btn-info' target="_blank"> Download</a>  
                                                    
                                                <?php } ?>
                                            </td>

                                            <td style='text-align  : center'>
                                                <div class="row form-group" id="service-image">
                                                    <div class="col-md-6">
                                                        <input type="file" name="file_{{$val['service_term_id']}}" id="file_{{$val['service_term_id']}}" value="" accept="image/*"/>
                                                    </div>
                                                </div> 
                                            </td>
                                        </tr>
                                    <?php
                                    $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>

                <br/>
                <div class="row">
                    <h5 class="form-section"><b>Formulir</b></h5>
                </div>
                <hr style="margin:0;">
                <br/>
                <?php foreach($servicerequisitionparameter as $key => $parameter){?>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a class="text-dark">{{$parameter['service_parameter_no'].'. '.$parameter['service_parameter_description']}}</a>
                                <textarea class="form-control input-bb" type="text" name="parameter_{{$parameter['service_parameter_id']}}" id="parameter_{{$parameter['service_parameter_id']}}"autocomplete="off">{{$parameter['service_requisition_parameter_value']}}</textarea>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
        
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <br>
    <br>                            
</form>



<?php foreach($servicerequisitionterm as $key => $val){
    if($val['service_requisition_term_value']!=''){
?>
    <div class="modal fade bs-modal-lg" id="showimage_{{$val['service_requisition_term_id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"  style='text-align:left !important'>
                    <h4>Gambar</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body form">
                        <div class="table-responsive" style="text-align : center;">
                            <img src="{{asset('storage/term/'.$servicerequisition['service_id'].'/'.$val['service_requisition_term_value'])}}" style="height:800px; width:700px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
        }
    }
?>


@stop

@section('footer')
    
@stop

@section('css')
    
@stop