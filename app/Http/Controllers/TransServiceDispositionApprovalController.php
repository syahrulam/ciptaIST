<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\CoreSection;
use App\Models\CoreService;
use App\Models\CoreServiceTerm;
use App\Models\CoreServiceParameter;
use App\Models\TransServiceDocumentRequisition;
use App\Models\TransServiceRequisition;
use App\Models\TransServiceRequisitionTerm;
use App\Models\TransServiceRequisitionParameter;
use App\Models\TransServiceDisposition;
use App\Models\TransServiceDispositionTerm;
use App\Models\TransServiceDispositionParameter;
use App\Models\TransServiceLog;
use App\Models\User;
use App\Models\SystemLogUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TransServiceDispositionApprovalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Session::forget('sess_servicedispositionapprovaltoken');
        Session::forget('sess_servicedispositionapprovaltokenedit');
        if(!Session::get('start_date')){
            $start_date     = date('Y-m-d');
        }else{
            $start_date = Session::get('start_date');
        }

        if(!Session::get('end_date')){
            $end_date     = date('Y-m-d');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }else{
            $end_date = Session::get('end_date');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }

        $section_id = Auth::user()->section_id;

        $transservicedisposition = TransServiceDisposition::where('data_state', 0)
        ->where('created_at','>=',$start_date)
        ->where('created_at','<=',$stop_date);

        if($section_id!=0){
            $transservicedisposition = $transservicedisposition->where('section_id', $section_id);
        }

        $transservicedisposition = $transservicedisposition->where('approved_status', 1)->orwhere('approved_status', 3)
        ->get();

        return view('content/TransServiceDispositionApproval/ListTransServiceDispositionApproval',compact('transservicedisposition', 'start_date', 'end_date'));
    }
    

    public function filter(Request $request){
        $start_date     = $request->start_date;
        $end_date       = $request->end_date;

        Session::put('start_date', $start_date);
        Session::put('end_date', $end_date);

        return redirect('/trans-service-disposition-approval');
    }

    public function search()
    {
        Session::forget('sess_servicedispositiontokenapproval');
        $transservicedisposition = TransServiceDisposition::select('trans_service_disposition.*', 'core_service.service_name')
        ->where('trans_service_disposition.data_state', 0)
        ->where('approved_status', 0)
        ->join('core_service', 'core_service.service_id', 'trans_service_disposition.service_id')
        ->get();

        return view('content/TransServiceDispositionApproval/SearchTransServiceDisposition',compact('transservicedisposition'));
    }

    public function editTransServiceDispositionApproval($service_disposition_id){
        $service_disposition_token_edit = Session::get('sess_servicedispositiontokenedit');

        if (empty($service_disposition_token_edit)){
            $service_disposition_token_edit = md5(date("YmdHis"));
            Session::put('sess_servicedispositiontokenedit', $service_disposition_token_edit);
        }

        $service_disposition_token_edit		= Session::get('sess_servicedispositiontokenedit');

        $servicedisposition = TransServiceDisposition::findOrFail($service_disposition_id);

        $servicedispositionparameter = TransServiceDispositionParameter::select('trans_service_disposition_parameter.*', 'core_service_parameter.*')
        ->join('core_service_parameter', 'core_service_parameter.service_parameter_id', 'trans_service_disposition_parameter.service_parameter_id')
        ->where('service_disposition_id', $service_disposition_id)
        ->where('trans_service_disposition_parameter.data_state', 0)
        ->get();

        return view('content/TransServiceDispositionApproval/FormEditTransServiceDisposition',compact('servicedisposition', 'servicedispositionparameter', 'service_disposition_id', 'service_disposition_token_edit'));
    }
    
    public function processEditTransServiceDispositionApproval(Request $request)
    {
        $fields = $request->validate([
            'service_id'                        => 'required',
            'service_disposition_id'            => 'required',
            'service_disposition_token_edit'    => 'required',
        ]);

        $coreserviceparameter = CoreServiceParameter::where('data_state', 0)
        ->where('service_id', $fields['service_id'])
        ->get();

        $servicerequisition = TransServiceRequisition::where('service_requisition_no', $request->service_requisition_no)->first();
        // print_r($servicerequisition['service_requisition_id']);exit;
        $allrequest = $request->all();

        $data = TransServiceDisposition::findOrFail($fields['service_disposition_id']);
        $data->service_disposition_token_edit   = $fields['service_disposition_token_edit'];
        $data->updated_id                       = Auth::id();
        $data->updated_at                       = date('Y-m-d H:i:s');
        
        if($data->save()){
            $username = User::select('name')->where('user_id','=',Auth::id())->first();

            $this->set_log(Auth::id(), $username['name'],'1089','Application.TransServiceDisposition.processEditTransServiceDisposition',$username['name'],'Edit Trans Service Disposition');
            
            foreach($coreserviceparameter as $key => $val){
                $transservicedispositionparameter = TransServiceDispositionParameter::where('service_disposition_id', $data['service_disposition_id'])
                ->where('service_parameter_id', $val['service_parameter_id'])
                ->first();

                $transservicedispositionparameter->service_disposition_parameter_value = $allrequest['parameter_'.$val['service_parameter_id']];
                $transservicedispositionparameter->updated_id = Auth::id();
                $transservicedispositionparameter->updated_at = date('Y-m-d H:i:s');
                
                $transservicerequisitionparameter = TransServiceRequisitionParameter::where('service_requisition_id', $servicerequisition['service_requisition_id'])
                ->where('service_parameter_id', $val['service_parameter_id'])
                ->first();

                $transservicerequisitionparameter->service_requisition_parameter_value = $allrequest['parameter_'.$val['service_parameter_id']];
                $transservicerequisitionparameter->updated_id = Auth::id();
                $transservicerequisitionparameter->updated_at = date('Y-m-d H:i:s');

                if($transservicedispositionparameter->save()){	
                    $transservicerequisitionparameter->save();
                    $username = User::select('name')->where('user_id','=',Auth::id())->first();

                    $this->set_log(Auth::id(), $username['name'],'1089','Application.TransServiceDisposition.processEditTransServiceDisposition',$username['name'],'Edit Trans Service Disposition');

                    $msg = "Edit Pengajuan Bantuan Berhasil";
                    continue;
                } else {
                    $msg = "Edit Pengajuan Bantuan Gagal";
                    return redirect('/trans-service-disposition-approval/edit/'.$fields['service_disposition_id'])->with('msg',$msg);
                    break;
                }
            }
            Session::forget('sess_servicedispositiontokenedit');
            $msg = "Edit Pengajuan Bantuan Berhasil";
            return redirect('/trans-service-disposition-approval/search')->with('msg',$msg);
        }else{
            $msg = "Edit Pengajuan Bantuan Gagal";
            return redirect('/trans-service-disposition-approval/edit/'.$fields['service_disposition_id'])->with('msg',$msg);
        }
    }

    public function addReset($service_requisition_id)
    {
        Session::forget('sess_servicerequisitiontokenedit');

        return redirect('/trans-service-disposition/add/'.$service_requisition_id);
    }

    public function addTransServiceDispositionApproval($service_disposition_id)
    {
        $service_disposition_approval_token_edit		    = Session::get('sess_servicedispositionapprovaltokenedit');

        if (empty($service_disposition_approval_token_edit)){
            $service_disposition_approval_token_edit = md5(date("YmdHis"));
            Session::put('sess_servicedispositionapprovaltokenedit', $service_disposition_approval_token_edit);
        }

        $service_disposition_approval_token_edit		= Session::get('sess_servicedispositionapprovaltokenedit');

        $servicedisposition = TransServiceDisposition::findOrFail($service_disposition_id);

        $servicedispositionterm = TransServiceDispositionTerm::select('trans_service_disposition_term.*', 'core_service_term.*')
        ->join('core_service_term', 'core_service_term.service_term_id', 'trans_service_disposition_term.service_term_id')
        ->where('service_disposition_id', $service_disposition_id)
        ->where('trans_service_disposition_term.data_state', 0)
        ->get();

        $servicedispositionparameter = TransServiceDispositionParameter::select('trans_service_disposition_parameter.*', 'core_service_parameter.*')
        ->join('core_service_parameter', 'core_service_parameter.service_parameter_id', 'trans_service_disposition_parameter.service_parameter_id')
        ->where('service_disposition_id', $service_disposition_id)
        ->where('trans_service_disposition_parameter.data_state', 0)
        ->get();

        return view('content/TransServiceDispositionApproval/FormAddTransServiceDispositionApproval',compact('servicedisposition', 'servicedispositionparameter', 'servicedispositionterm', 'service_disposition_approval_token_edit', 'service_disposition_id'));
    }

    public function detailTransServiceDispositionApproval($service_disposition_id){
        $servicedisposition = TransServiceDisposition::findOrFail($service_disposition_id);

        $servicedispositionterm = TransServiceDispositionTerm::select('trans_service_disposition_term.*', 'core_service_term.*')
        ->join('core_service_term', 'core_service_term.service_term_id', 'trans_service_disposition_term.service_term_id')
        ->where('service_disposition_id', $service_disposition_id)
        ->where('trans_service_disposition_term.data_state', 0)
        ->get();

        $servicedispositionparameter = TransServiceDispositionParameter::select('trans_service_disposition_parameter.*', 'core_service_parameter.*')
        ->join('core_service_parameter', 'core_service_parameter.service_parameter_id', 'trans_service_disposition_parameter.service_parameter_id')
        ->where('service_disposition_id', $service_disposition_id)
        ->where('trans_service_disposition_parameter.data_state', 0)
        ->get();

        return view('content/TransServiceDispositionApproval/FormDetailTransServiceDispositionApproval',compact('servicedisposition', 'servicedispositionterm', 'servicedispositionparameter', 'service_disposition_id'));
    }

    public function unApproveTransServiceDispositionApproval($service_disposition_id){
        $service_disposition_approval_token_edit		    = Session::get('sess_servicedispositionapprovaltokenedit');

        if (empty($service_disposition_approval_token_edit)){
            $service_disposition_approval_token_edit = md5(date("YmdHis"));
            Session::put('sess_servicedispositionapprovaltokenedit', $service_disposition_approval_token_edit);
        }

        $service_disposition_approval_token_edit		= Session::get('sess_servicedispositionapprovaltokenedit');

        $servicedisposition = TransServiceDisposition::findOrFail($service_disposition_id);

        $servicedispositionterm = TransServiceDispositionTerm::select('trans_service_disposition_term.*', 'core_service_term.*')
        ->join('core_service_term', 'core_service_term.service_term_id', 'trans_service_disposition_term.service_term_id')
        ->where('service_disposition_id', $service_disposition_id)
        ->where('trans_service_disposition_term.data_state', 0)
        ->get();

        $servicedispositionparameter = TransServiceDispositionParameter::select('trans_service_disposition_parameter.*', 'core_service_parameter.*')
        ->join('core_service_parameter', 'core_service_parameter.service_parameter_id', 'trans_service_disposition_parameter.service_parameter_id')
        ->where('service_disposition_id', $service_disposition_id)
        ->where('trans_service_disposition_parameter.data_state', 0)
        ->get();

        $coresection    = CoreSection::where('data_state', 0)
        ->pluck('section_name', 'section_id');

        return view('content/TransServiceDispositionApproval/FormUnApproveTransServiceDispositionApproval',compact('servicedisposition', 'servicedispositionparameter', 'servicedispositionterm', 'service_disposition_approval_token_edit', 'service_disposition_id', 'coresection'));
    }
    

    public function addElementsCoreService(Request $request)
    {
        $data_coreservice[$request->name] = $request->value;

        Session::put('data_coreservice', $data_coreservice);
        
        return redirect('/service/add');
    }

    public function processAddTransServiceDispositionApproval(Request $request)
    {
        $fields = $request->validate([
            'service_disposition_id'                    => 'required',
            'approved_remark'                           => 'required',
            'service_disposition_approval_token_edit'   => 'required',
        ]);

        $servicedisposition = TransServiceDisposition::findOrFail($fields['service_disposition_id']);
        if(Auth::user()->section_id != 0 && Auth::user()->section_id != $servicedisposition['section_id']){
            $msg = "Gagal, Hanya User Dengan Bagian Sama Dapat Memproses Data Ini";
            return redirect('/trans-service-disposition-approval/add/'.$fields['service_disposition_id'])->with('msg',$msg);
        }
        $servicedisposition->approved_status = 1;
        $servicedisposition->approved_id     = Auth::id();
        $servicedisposition->approved_at     = date('Y-m-d H:i:s');
        $servicedisposition->approved_remark = $fields['approved_remark'];

        $service_disposition_approval_token_edit  = TransServiceDisposition::select('service_disposition_token_edit')
            ->where('service_disposition_token_edit', $fields['service_disposition_approval_token_edit'])
            ->count();
            
        $service_requisition_id = $servicedisposition['service_requisition_id'];
        $servicerequisition     = TransServiceRequisition::where('data_state', 0)
        ->where('service_requisition_id', $service_requisition_id)
        ->first(); 

        if($service_disposition_approval_token_edit == 0){
            if($servicedisposition->save()){
                $username = User::select('name')->where('user_id','=',Auth::id())->first();

                $this->set_log(Auth::id(), $username['name'],'1089','Application.TransServiceDispositionApproval.processAddTransServiceDispositionApproval',$username['name'],'Add Trans Service Disposition Approval');

                $servicerequisition->service_requisition_status = 3;
                if($servicerequisition->save()){  
                    $msg = "Persetujuan Disposisi Bantuan Berhasil";
                }else{
                    $msg = "Persetujuan Disposisi Bantuan Gagal";
                    return redirect('/trans-service-disposition-approval/add/'.$fields['service_disposition_id'])->with('msg',$msg);
                }
                
                $disposition_data = TransServiceDisposition::findOrFail($fields['service_disposition_id']);

                $service_log = array(
                    'service_status'            => 3,
                    'service_requisition_no'    => $disposition_data['service_requisition_no'],
                    'section_id'                => $disposition_data['section_id'],
                    'created_id'                => Auth::id(),
                );
                TransServiceLog::create($service_log);

                $wa_msg = "SMArT Baznas Sragen\r\n\r\n\r\nNama : ".$disposition_data['service_requisition_name']."\r\n\r\nNomor Pengajuan : ".$disposition_data['service_requisition_no']."\r\n\r\nJenis Pengajuan : ".$this->getServiceName($disposition_data['service_id'])."\r\n\r\nBagian : ".$this->getSectionName($disposition_data['section_id'])."\r\n\r\nPesan : ".$this->getMessage(3);
                $wa_status = $this->getMessageStatus(3);
                $wa_no  = $disposition_data['service_requisition_phone'];
                $this->postWhatsappMessages($wa_msg, $wa_status, $wa_no);
                
                $msg = "Persetujuan Disposisi Bantuan Berhasil";
                return redirect('/trans-service-disposition-approval')->with('msg',$msg);
            }else{
                $msg = "Persetujuan Disposisi Bantuan Gagal";
                return redirect('/trans-service-disposition-approval/add/'.$fields['service_disposition_id'])->with('msg',$msg);
            }
        }else{
            $servicerequisition->service_requisition_status = 3;
            if($servicerequisition->save()){  
                $msg = "Persetujuan Disposisi Bantuan Berhasil";
            }else{
                $msg = "Persetujuan Disposisi Bantuan Gagal";
                return redirect('/trans-service-disposition-approval/add/'.$fields['service_disposition_id'])->with('msg',$msg);
            }
            
            $disposition_data = TransServiceDisposition::findOrFail($fields['service_disposition_id']);

            $service_log = array(
                'service_status'            => 3,
                'service_requisition_no'    => $disposition_data['service_requisition_no'],
                'section_id'                => $disposition_data['section_id'],
                'created_id'                => Auth::id(),
            );
            TransServiceLog::create($service_log);

            $wa_msg = "SMArT Baznas Sragen\r\n\r\n\r\nNama : ".$disposition_data['service_requisition_name']."\r\n\r\nNomor Pengajuan : ".$disposition_data['service_requisition_no']."\r\n\r\nJenis Pengajuan : ".$this->getServiceName($disposition_data['service_id'])."\r\n\r\nBagian : ".$this->getSectionName($disposition_data['section_id'])."\r\n\r\nPesan : ".$this->getMessage(3);
            $wa_status = $this->getMessageStatus(3);
            $wa_no  = $disposition_data['service_requisition_phone'];
            $this->postWhatsappMessages($wa_msg, $wa_status, $wa_no);
            
            $msg = "Persetujuan Disposisi Bantuan Berhasil";
            return redirect('/trans-service-disposition-approval/add/'.$fields['service_disposition_id'])->with('msg',$msg);
        }
    }

    public function processUnApproveTransServiceDispositionApproval(Request $request)
    {
        $fields = $request->validate([
            'service_disposition_id'                    => 'required',
            'unapprove_remark'                          => 'required',
            'service_disposition_approval_token_edit'   => 'required',
        ]);

        $servicedisposition = TransServiceDisposition::findOrFail($fields['service_disposition_id']);
        if(Auth::user()->section_id != 0 && Auth::user()->section_id != $servicedisposition['section_id']){
            $msg = "Gagal, Hanya User Dengan Bagian Sama Dapat Memproses Data Ini";
            return redirect('/trans-service-disposition-approval/unapprove/'.$fields['service_disposition_id'])->with('msg',$msg);
        }
        $servicedisposition->approved_status     = 0;
        $servicedisposition->unapprove_id       = Auth::id();
        $servicedisposition->unapprove_at       = date('Y-m-d H:i:s');
        $servicedisposition->unapprove_remark   = $fields['unapprove_remark'];

        $service_disposition_approval_token_edit  = TransServiceDisposition::select('service_disposition_token_edit')
            ->where('service_disposition_token_edit', $fields['service_disposition_approval_token_edit'])
            ->count();
            
        $service_requisition_id = $servicedisposition['service_requisition_id'];
        $servicerequisition     = TransServiceRequisition::where('data_state', 0)
        ->where('service_requisition_id', $service_requisition_id)
        ->first(); 

        if($service_disposition_approval_token_edit == 0){
            if($servicedisposition->save()){
                $username = User::select('name')->where('user_id','=',Auth::id())->first();

                $this->set_log(Auth::id(), $username['name'],'1089','Application.TransServiceDispositionApproval.processUnApproveTransServiceDispositionApproval',$username['name'],'UnApprove Trans Service Disposition Approval');

                $servicerequisition->service_requisition_status = 1;
                if($servicerequisition->save()){  
                    $msg = "Persetujuan Disposisi Bantuan Berhasil";
                }else{
                    $msg = "Persetujuan Disposisi Bantuan Gagal";
                    return redirect('/trans-service-disposition-approval/unapprove/'.$fields['service_disposition_id'])->with('msg',$msg);
                }
            
                $disposition_data = TransServiceDisposition::findOrFail($fields['service_disposition_id']);

                $service_log = array(
                    'service_status'            => 6,
                    'service_requisition_no'    => $disposition_data['service_requisition_no'],
                    'section_id'                => $disposition_data['section_id'],
                    'created_id'                => Auth::id(),
                );
                TransServiceLog::create($service_log);
    
                $wa_msg = "SMArT Baznas Sragen\r\n\r\n\r\nNama : ".$disposition_data['service_requisition_name']."\r\n\r\nNomor Pengajuan : ".$disposition_data['service_requisition_no']."\r\n\r\nJenis Pengajuan : ".$this->getServiceName($disposition_data['service_id'])."\r\n\r\nBagian : ".$this->getSectionName($disposition_data['section_id'])."\r\n\r\nPesan : ".$this->getMessage(6);
                $wa_status = $this->getMessageStatus(6);
                $wa_no  = $disposition_data['service_requisition_phone'];
                $this->postWhatsappMessages($wa_msg, $wa_status, $wa_no);

                $msg = "Pembatalan Persetujuan Disposisi Bantuan Berhasil";
                return redirect('/trans-service-disposition-approval')->with('msg',$msg);
            }else{
                $msg = "Pembatalan Persetujuan Disposisi Bantuan Gagal";
                return redirect('/trans-service-disposition-approval/unapprove/'.$fields['service_disposition_id'])->with('msg',$msg);
            }
        }else{
            $servicerequisition->service_requisition_status = 1;
            if($servicerequisition->save()){  
                $msg = "Persetujuan Disposisi Bantuan Berhasil";
            }else{
                $msg = "Persetujuan Disposisi Bantuan Gagal";
                return redirect('/trans-service-disposition-approval/unapprove/'.$fields['service_disposition_id'])->with('msg',$msg);
            }
            
            $disposition_data = TransServiceDisposition::findOrFail($fields['service_disposition_id']);

            $service_log = array(
                'service_status'            => 6,
                'service_requisition_no'    => $disposition_data['service_requisition_no'],
                'section_id'                => $disposition_data['section_id'],
                'created_id'                => Auth::id(),
            );
            TransServiceLog::create($service_log);

            $wa_msg = "SMArT Baznas Sragen\r\n\r\n\r\nNama : ".$disposition_data['service_requisition_name']."\r\n\r\nNomor Pengajuan : ".$disposition_data['service_requisition_no']."\r\n\r\nJenis Pengajuan : ".$this->getServiceName($disposition_data['service_id'])."\r\n\r\nBagian : ".$this->getSectionName($disposition_data['section_id'])."\r\n\r\nPesan : ".$this->getMessage(6);
            $wa_status = $this->getMessageStatus(6);
            $wa_no  = $disposition_data['service_requisition_phone'];
            $this->postWhatsappMessages($wa_msg, $wa_status, $wa_no);

            $msg = "Pembatalan Persetujuan Disposisi Bantuan Berhasil";
            return redirect('/trans-service-disposition-approval')->with('msg',$msg);
        }
    }

    

    public function processDisapproveTransServiceDispositionApproval(Request $request)
    {
        $fields = $request->validate([
            'service_disposition_id'                    => 'required',
            'disapprove_remark'                         => 'required',
            'service_disposition_approval_token_edit'   => 'required',
        ]);

        $servicedisposition = TransServiceDisposition::findOrFail($fields['service_disposition_id']);
        if(Auth::user()->section_id != 0 && Auth::user()->section_id != $servicedisposition['section_id']){
            $msg = "Gagal, Hanya User Dengan Bagian Sama Dapat Memproses Data Ini";
            return redirect('/trans-service-disposition-approval/add/'.$fields['service_disposition_id'])->with('msg',$msg);
        }
        $servicedisposition->approved_status   = 3;
        $servicedisposition->disapprove_id     = Auth::id();
        $servicedisposition->disapprove_at     = date('Y-m-d H:i:s');
        $servicedisposition->disapprove_remark = $fields['disapprove_remark'];

        $service_disposition_approval_token_edit = TransServiceDisposition::select('service_disposition_token_edit')
            ->where('service_disposition_token_edit', $fields['service_disposition_approval_token_edit'])
            ->count();
            
        $service_requisition_id = $servicedisposition['service_requisition_id'];
        $servicerequisition     = TransServiceRequisition::where('data_state', 0)
        ->where('service_requisition_id', $service_requisition_id)
        ->first(); 

        if($service_disposition_approval_token_edit == 0){
            if($servicedisposition->save()){
                $username = User::select('name')->where('user_id','=',Auth::id())->first();

                $this->set_log(Auth::id(), $username['name'],'1089','Application.TransServiceDispositionApproval.processDisapproveTransServiceDispositionApproval',$username['name'],'Disapprove Trans Service Disposition Approval');

                $servicerequisition->service_requisition_status = 6;
                if($servicerequisition->save()){  
                    $msg = "Disapprove Disposisi Bantuan Berhasil";
                }else{
                    $msg = "Disapprove Disposisi Bantuan Gagal";
                    return redirect('/trans-service-disposition-approval/add/'.$fields['service_disposition_id'])->with('msg',$msg);
                }
            
                $disposition_data = TransServiceDisposition::findOrFail($fields['service_disposition_id']);

                $service_log = array(
                    'service_status'            => 10,
                    'service_requisition_no'    => $disposition_data['service_requisition_no'],
                    'section_id'                => $disposition_data['section_id'],
                    'created_id'                => Auth::id(),
                );
                TransServiceLog::create($service_log);
    
                $wa_msg = "SMArT Baznas Sragen\r\n\r\n\r\nNama : ".$disposition_data['service_requisition_name']."\r\n\r\nNomor Pengajuan : ".$disposition_data['service_requisition_no']."\r\n\r\nJenis Pengajuan : ".$this->getServiceName($disposition_data['service_id'])."\r\n\r\nBagian : ".$this->getSectionName(1)."\r\n\r\nPesan : ".$this->getMessage(9);
                $wa_status = $this->getMessageStatus(9);
                $wa_no  = $disposition_data['service_requisition_phone'];
                $this->postWhatsappMessages($wa_msg, $wa_status, $wa_no);

                $msg = "Disapprove Disposisi Bantuan Berhasil";
                return redirect('/trans-service-disposition-approval')->with('msg',$msg);
            }else{
                $msg = "Disapprove Disposisi Bantuan Gagal";
                return redirect('/trans-service-disposition-approval/add/'.$fields['service_disposition_id'])->with('msg',$msg);
            }
        }else{
            $servicerequisition->service_requisition_status = 6;
            if($servicerequisition->save()){  
                $msg = "Disapprove Disposisi Bantuan Berhasil";
            }else{
                $msg = "Disapprove Disposisi Bantuan Gagal";
                return redirect('/trans-service-disposition-approval/add/'.$fields['service_disposition_id'])->with('msg',$msg);
            }
            
            $disposition_data = TransServiceDisposition::findOrFail($fields['service_disposition_id']);

            $service_log = array(
                'service_status'            => 10,
                'service_requisition_no'    => $disposition_data['service_requisition_no'],
                'section_id'                => $disposition_data['section_id'],
                'created_id'                => Auth::id(),
            );
            TransServiceLog::create($service_log);

            $wa_msg = "SMArT Baznas Sragen\r\n\r\n\r\nNama : ".$disposition_data['service_requisition_name']."\r\n\r\nNomor Pengajuan : ".$disposition_data['service_requisition_no']."\r\n\r\nJenis Pengajuan : ".$this->getServiceName($disposition_data['service_id'])."\r\n\r\nBagian : ".$this->getSectionName($disposition_data['section_id'])."\r\n\r\nPesan : ".$this->getMessage(9);
            $wa_status = $this->getMessageStatus(9);
            $wa_no  = $disposition_data['service_requisition_phone'];
            $this->postWhatsappMessages($wa_msg, $wa_status, $wa_no);
            
            $msg = "Disapprove Disposisi Bantuan Berhasil";
            return redirect('/trans-service-disposition-approval')->with('msg',$msg);
        }
    }
    public function processFundsReceived($service_disposition_id)
    {
        $servicedisposition = TransServiceDisposition::findOrFail($service_disposition_id);
        if(Auth::user()->section_id != 0 && Auth::user()->section_id != $servicedisposition['section_id']){
            $msg = "Gagal, Hanya User Dengan Bagian Sama Dapat Memproses Data Ini";
            return redirect('/trans-service-disposition-approval')->with('msg',$msg);
        }
        $servicedisposition->service_disposition_funds_status   = 2;
        $servicedisposition->funds_status_id                    = Auth::id();
        $servicedisposition->funds_status_at                    = date('Y-m-d H:i:s');
            
        $service_requisition_id = $servicedisposition['service_requisition_id'];
        $servicerequisition     = TransServiceRequisition::where('data_state', 0)
        ->where('service_requisition_id', $service_requisition_id)
        ->first(); 

        if($servicedisposition->save()){
            $username = User::select('name')->where('user_id','=',Auth::id())->first();

            $this->set_log(Auth::id(), $username['name'],'1089','Application.TransServiceDispositionApproval.processFundReceivedTransServiceDispositionApproval',$username['name'],'Funds Received Trans Service Disposition Approval');

            $servicerequisition->service_requisition_status = 8;
            if($servicerequisition->save()){  
                $msg = "Penyaluran Bantuan Disposisi Berhasil";
            }else{
                $msg = "Penyaluran Bantuan Disposisi Gagal";
                return redirect('/trans-service-disposition-approval')->with('msg',$msg);
            }
            
            $disposition_data = TransServiceDisposition::findOrFail($service_disposition_id);

            $service_log = array(
                'service_status'            => 12,
                'service_requisition_no'    => $disposition_data['service_requisition_no'],
                'section_id'                => $disposition_data['section_id'],
                'created_id'                => Auth::id(),
            );
            TransServiceLog::create($service_log);

            $wa_msg = "SMArT Baznas Sragen\r\n\r\n\r\nNama : ".$disposition_data['service_requisition_name']."\r\n\r\nNomor Pengajuan : ".$disposition_data['service_requisition_no']."\r\n\r\nJenis Pengajuan : ".$this->getServiceName($disposition_data['service_id'])."\r\n\r\nBagian : ".$this->getSectionName($disposition_data['section_id'])."\r\n\r\nPesan : ".$this->getMessage(11);
            $wa_status = $this->getMessageStatus(11);
            $wa_no  = $disposition_data['service_requisition_phone'];
            $this->postWhatsappMessages($wa_msg, $wa_status, $wa_no);
            
            $msg = "Penyaluran Bantuan Disposisi Berhasil";
            return redirect('/trans-service-disposition-approval')->with('msg',$msg);
        }else{
            $msg = "Penyaluran Bantuan Disposisi Gagal";
            return redirect('/trans-service-disposition-approval')->with('msg',$msg);
        }
    }

    public function editReset($service_id)
    {
        Session::forget('data_coreserviceterm');
        Session::forget('data_coreserviceterm_first');
        Session::forget('data_coreserviceparameter_first');

        return redirect('/service/edit/'.$service_id);
    }

    public function set_log($user_id, $username, $id, $class, $pk, $remark){

		date_default_timezone_set("Asia/Jakarta");

		$log = array(
			'user_id'		=>	$user_id,
			'username'		=>	$username,
			'id_previllage'	=> 	$id,
			'class_name'	=>	$class,
			'pk'			=>	$pk,
			'remark'		=> 	$remark,
			'log_stat'		=>	'1',
			'log_time'		=>	date("Y-m-d G:i:s")
		);
		return SystemLogUser::create($log);
	}

    public function getServiceName($service_id){
        $service = CoreService::where('data_state', 0)
        ->where('service_id', $service_id)
        ->first();

        return $service['service_name'];
    }

    public function getSectionName($section_id){
        $section = CoreSection::where('data_state', 0)
        ->where('section_id', $section_id)
        ->first();

        return $section['section_name'];
    }

    public function downloadTransServiceDispositionTerm($service_id, $service_disposition_term_id){
        $dispositionterm = TransServiceDispositionTerm::findOrFail($service_disposition_term_id);
        
        return response()->download(
            storage_path('app/public/term/'.$service_id.'/'.$dispositionterm['service_disposition_term_value']),
            'term_'.$dispositionterm['service_disposition_term_id'].'.png',
        );
    }
}
