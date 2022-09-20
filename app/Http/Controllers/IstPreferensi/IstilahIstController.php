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

class IstilahIstController extends Controller
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
        $getIstIST = DB::table('core_service_parameter')->get();
        $return = [
            'getIstIST'
        ];
        return view('content/IstilahIST/IstilahIST', compact($return));
    }
    public function tambahistilahist()
    {
        $coreservice = CoreService::where('data_state', 0)
        ->get();

        return view('content/IstilahIST/TambahIstilahIST',compact('coreservice'));
    }

    public function addprosesistilahist(Request $request)
    {
        $request->validate([
            'kodeist'=>'required',
            'usianormamulai'=>'required',
            'usianormaakhir'=>'required',
            'istrw'=>'required',
            'istsw'=>'required',
            'normatotalmulai'=>'required',
            'normatotalakhir'=>'required',
        ]);

        $query = DB::table('core_service_parameter')->insert([
            'service_parameter_id'=>$request->input('kodeist'),
            'service_id'=>$request->input('usianormamulai'),
            'service_parameter_no'=>$request->input('usianormaakhir'),
            'service_parameter_description'=>$request->input('istrw'),
            'data_state'=>$request->input('istsw'),
            'created_id'=>$request->input('normatotalmulai'),
            'updated_id'=>$request->input('normatotalakhir')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

        public function editistilahist()
    {
        return view('content\IstilahIST\EditIstilahIST');
    }
};