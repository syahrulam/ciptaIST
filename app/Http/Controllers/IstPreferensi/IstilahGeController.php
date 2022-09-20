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

class IstilahGeController extends Controller
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
        $getGe = DB::table('trans_service_disposition')->get();
        $return = [
            'getGe'
        ];
        return view('content/IstilahGE/IstilahGE', compact($return));
    }
    public function tambahistilahge()
    {
        $coreservice = CoreService::where('data_state', 0)
        ->get();

        return view('content/IstilahGE/TambahIstilahGE',compact('coreservice'));
    }

    public function addprosesistilahge(Request $request)
    {
        $request->validate([
            'totalgeawal'=>'required',
            'totalgeakhir'=>'required',
            'nilaige'=>'required'
        ]);

        $query = DB::table('trans_service_disposition')->insert([
            'service_id'=>$request->input('totalgeawal'),
            'section_id'=>$request->input('totalgeakhir'),
            'approved_id'=>$request->input('nilaige')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

        public function editistilahge()
    {
        return view('content\IstilahGe\EditIstilahGe');
    }

};