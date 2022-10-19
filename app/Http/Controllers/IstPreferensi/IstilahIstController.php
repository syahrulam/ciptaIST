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
        $core_ist = DB::connection('mysqll')->table('core_ist')->get();
        $core_ist_norm = DB::connection('mysqll')->table('core_ist_norm')->get();
        $return = [
            'core_ist',
            'core_ist_norm'
        ];
        return view('content\IstilahIST\IstilahIST', compact($return));
    }
    public function tambahistilahist()
    {
        return view('content\IstilahIST\TambahIstilahIST');
    }

    public function addprosesistilahist(Request $request)
    {
        $request->validate([
            'kodeist'=>'required',
        ]);

        $query = DB::connection('mysqll')->table('core_ist')->insert([
            'service_parameter_id'=>$request->input('kodeist'),

        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editistilahist($id){

        $core_ist = DB::connection('mysqll')->table('core_ist')->where('ist_id',$id)->get();
        return view('content\IstilahIST\EditIstilahIST',['core_ist'=>$core_ist]);
    }

    public function editistilahistproses(Request $request){

	    DB::connection('mysqll')->table('core_ist')->where('ist_id',$request->id)->update([
            'ist_code'=>$request->kodeist
	]);

	return redirect('/istilah-ist');
    }

    public function hapusist($id)
    {
        DB::connection('mysqll')->table('core_ist')->where('ist_id',$id)->delete();

	    return redirect('/istilah-ist');
    }
};