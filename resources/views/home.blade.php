@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

{{-- @section('content_header')
    
Dashboard

@stop --}}

@section('content')
    
<br>

<div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Menu Utama
        </h5>
    </div>

    <div class="card-body">
        <div class="row">
            <div class='col-md-6'>
                <div class="card" style="height: 330px;">
                    <div class="card-header bg-secondary">
                    IST : Preferensi
                    </div>
                    <div class="card-body">
                    <ul class="list-group">
                    <?php foreach($menus as $menu){
                            if($menu['id_menu']==221){
                    ?>
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-requisition')}}'"> <i class="fa fa-angle-right"></i> IST</li>
                    <?php   }
                            if($menu['id_menu']==231){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-disposition')}}'"> <i class="fa fa-angle-right"></i> Istilah IST</li>
                    <?php   }
                            if($menu['id_menu']==232){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-disposition-approval')}}'"> <i class="fa fa-angle-right"></i> Istilah GE</li>
                    <?php   }
                            if($menu['id_menu']==233){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-disposition-review')}}'"> <i class="fa fa-angle-right"></i> Istilah IQ</li>            
                    <?php   }
                            if($menu['id_menu']==234){
                    ?> 
                            <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-disposition-review')}}'"> <i class="fa fa-angle-right"></i> GESAMT</li>            
                    <?php  
                            }     
                        } 
                    ?>               
                    </ul>
                </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class="card" style="height: 330px;">
                    <div class="card-header bg-info">
                    Klasifikasi
                    </div>
                    <div class="card-body scrollable">
                        <ul class="list-group">
                        <?php foreach($menus as $menu){
                            if($menu['id_menu']==41){
                        ?>
                            <li class="list-group-item main-menu-item-b" onClick="location.href='{{route('print-service')}}'"> <i class="fa fa-angle-right"></i> Klasifikasi Nilai</li>          
                        <?php   }
                            if($menu['id_menu']==42){
                        ?> 
                            <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-general-print')}}'"> <i class="fa fa-angle-right"></i> Klasifikasi IST</li>     
                        <?php   }
                            if($menu['id_menu']==41){
                        ?> 
                            <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-general-print')}}'"> <i class="fa fa-angle-right"></i> Klasifikasi IQ</li>     
                        <?php   }
                            if($menu['id_menu']==6){
                        ?> 
                            <li class="list-group-item main-menu-item" onClick="location.href='{{route('dashboard-review')}}'"> <i class="fa fa-angle-right"></i> Dashboard Review</li>         
                        <?php 
                            }
                        } 
                        ?>           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class='col-md-6'>
                <div class="card" style="height: 330px;">
                    <div class="card-header bg-info">
                    Tes : Preferensi
                    </div>
                    <div class="card-body">
                    <ul class="list-group">
                    <?php foreach($menus as $menu){
                        if($menu['id_menu']==32){
                    ?>
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-general')}}'"> <i class="fa fa-angle-right"></i> Pertanyaan</li>         
                    <?php   }
                        if($menu['id_menu']==33){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-general-approval')}}'"> <i class="fa fa-angle-right"></i> Kategori Ujian</li>  
                    <?php   }
                        if($menu['id_menu']==32){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-general-approval')}}'"> <i class="fa fa-angle-right"></i> Tipe User</li>  
                    <?php   }  
                        if($menu['id_menu']==33){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-general-approval')}}'"> <i class="fa fa-angle-right"></i> Klien</li>  
                    <?php   }  
                        if($menu['id_menu']==32){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('service-general-approval')}}'"> <i class="fa fa-angle-right"></i> Edukasi</li>  
                    <?php  
                        }  
                    } 
                    ?>                    
                    </ul>
                </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class="card" style="height: 330px;">
                    <div class="card-header bg-secondary">
                    Data Preferensi
                    </div>
                    <div class="card-body">
                    <ul class="list-group">
                    <?php foreach($menus as $menu){
                            if($menu['id_menu']==41){
                    ?>
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('messages')}}'"> <i class="fa fa-angle-right"></i> Data Tes</li>
                    <?php   }
                            if($menu['id_menu']==42){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('scan-qr')}}'"> <i class="fa fa-angle-right"></i> Tes IST</li>      
                    <?php   }
                            if($menu['id_menu']==41){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('reload-scan-qr')}}'"> <i class="fa fa-angle-right"></i> Hasil Tes IST</li>  
                    <?php   }
                            if($menu['id_menu']==42){
                    ?> 
                        <li class="list-group-item main-menu-item" onClick="location.href='{{route('reload-scan-qr')}}'"> <i class="fa fa-angle-right"></i> Peserta Tes IST</li>  
                    <?php 
                         }
                    } 
                    ?>                        
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
</form>


@stop

@section('css')
    
@stop

@section('js')
    
@stop