<?php

namespace App\Http\Controllers\IstPreferensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\CoreService;
use App\Models\CoreSection;
use App\Models\CoreServiceTerm;
use App\Models\CoreServiceParameter;
use App\Models\TransServiceDocumentRequisition;
use App\Models\TransServiceLog;
use App\Models\TransServiceRequisition;
use App\Models\TransServiceRequisitionTerm;
use App\Models\TransServiceRequisitionParameter;
use App\Models\User;
use App\Models\SystemLogUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Elibyy\TCPDF\Facades\TCPDF;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class IstilahIqController extends Controller
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
    public function index(){
        $getIstIq = DB::table('core_service_parameter')->get();
        $return = [
            'getIstIq'
        ];
        return view('content/IstilahIQ/IstilahIQ', compact($return));
    }
    public function tambahistilahiq()
    {
        $coreservice = CoreService::where('data_state', 0)
        ->get();

        return view('content/IstilahIQ/TambahIstilahIQ',compact('coreservice'));
    }

    public function addprosesistilahiq(Request $request)
    {
        $request->validate([
            'iqswmulai'=>'required',
            'iqswakhir'=>'required',
            'nilaiiq'=>'required',
            'presentaseiq'=>'required'
        ]);

        $query = DB::table('trans_service_requisition')->insert([
            'service_requisition_no'=>$request->input('iqswmulai'),
            'service_requisition_name'=>$request->input('iqswakhir'),
            'delete_remark'=>$request->input('nilaiiq'),
            'service_requisition_status'=>$request->input('presentaseiq')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editistilahiq()
    {
        return view('content\IstilahIq\EditIstilahIq');
    }

};