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

class IstController extends Controller
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
        $return = [
            'core_ist'
        ];
        return view('content/IST/IstHal', compact($return));
    }
    public function tambahist()
    {
        return view('content/IST/TambahIstBaru');
    }

    public function addprosesist(Request $request)
    {
        $request->validate([
            'kodeist'=>'required',
            'namaist'=>'required',
            'durasiist'=>'required',
            'deskripsiist'=>'required'
        ]);

        $query = DB::connection('mysqll')->table('core_ist')->insert([
            'ist_code'=>$request->input('kodeist'),
            'ist_name'=>$request->input('namaist'),
            'ist_duration'=>$request->input('durasiist'),
            'ist_description'=>$request->input('deskripsiist')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editist($id){

        $core_ist = DB::connection('mysqll')->table('core_ist')->where('ist_id',$id)->get();
        return view('content\IST\EditIst',['core_ist'=>$core_ist]);
    }

    public function editistproses(Request $request){

	    DB::connection('mysqll')->table('core_ist')->where('ist_id',$request->id)->update([
            'ist_code'=>$request->kodeist,
            'ist_name'=>$request->namaist,
            'ist_duration'=>$request->durasiist,
            'ist_description'=>$request->deskripsiist
	]);

	return redirect('/ist');
    }

    public function hapusist($id)
    {
        DB::connection('mysqll')->table('core_ist')->where('ist_id',$id)->delete();

	    return redirect('/ist');
    }
};