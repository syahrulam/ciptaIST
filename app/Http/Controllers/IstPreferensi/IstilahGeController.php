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
        $core_norm_ge =  DB::connection('mysqll')->table('core_norm_ge')->get();
        $return = [
            'core_norm_ge'
        ];
        return view('content/IstilahGE/IstilahGE', compact($return));
    }
    public function tambahistilahge()
    {
        return view('content/IstilahGE/TambahIstilahGE');
    }

    public function addprosesistilahge(Request $request)
    {
        $request->validate([
            'totalgeawal'=>'required',
            'totalgeakhir'=>'required',
            'nilaige'=>'required'
        ]);

        $query = DB::connection('mysqll')->table('core_norm_ge')->insert([
            'norm_ge_total_start'=>$request->input('totalgeawal'),
            'norm_ge_total_end'=>$request->input('totalgeakhir'),
            'norm_ge_value'=>$request->input('nilaige')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editistilahge($id)
    {

        $core_norm_ge = DB::connection('mysqll')->table('core_norm_ge')->where('norm_ge_id',$id)->get();
        return view('content\IstilahGE\EditIstilahGe',['core_norm_ge'=>$core_norm_ge]);
    }

    public function editistilahgeproses(Request $request){

	    DB::connection('mysqll')->table('core_norm_ge')->where('norm_ge_id',$request->id)->update([
            'norm_ge_total_start'=>$request->totalgeawal,
            'norm_ge_total_end'=>$request->totalgeakhir,
            'norm_ge_value'=>$request->nilaige
	]);

	return redirect('/istilah-ge');
    }

    public function hapusistilahge($id)
    {
        DB::connection('mysqll')->table('core_norm_ge')->where('norm_ge_id',$id)->delete();

	    return redirect('/istilah-ge');
    }

};