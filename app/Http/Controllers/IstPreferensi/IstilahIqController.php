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
        $core_norm_iq =  DB::connection('mysqll')->table('core_norm_iq')->get();
        $return = [
            'core_norm_iq'
        ];
        return view('content\IstilahIQ\IstilahIQ', compact($return));
    }
    public function tambahistilahiq()
    {
        return view('content\IstilahIQ\TambahIstilahIQ');
    }

    public function addprosesistilahiq(Request $request)
    {
        $request->validate([
            'totaliqawal'=>'required',
            'totaliqakhir'=>'required',
            'nilaiiq'=>'required'
        ]);

        $query = DB::connection('mysqll')->table('core_norm_iq')->insert([
            'norm_iq_sw_start'=>$request->input('totaliqawal'),
            'norm_iq_sw_end'=>$request->input('totaliqakhir'),
            'norm_iq_value'=>$request->input('nilaiiq'),
            'norm_iq_percentage'=>$request->input('presentasiiq')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editistilahiq($id)
    {

        $core_norm_iq = DB::connection('mysqll')->table('core_norm_iq')->where('norm_iq_id',$id)->get();
        return view('content\IstilahIQ\EditIstilahIq',['core_norm_iq'=>$core_norm_iq]);
    }

    public function editistilahiqproses(Request $request){

	    DB::connection('mysqll')->table('core_norm_iq')->where('norm_iq_id',$request->id)->update([
            'norm_iq_sw_start'=>$request->totaliqawal,
            'norm_iq_sw_end'=>$request->totaliqakhir,
            'norm_iq_value'=>$request->nilaiiq,
            'norm_iq_percentage'=>$request->presentasiiq
	]);

	return redirect('/istilah-iq');
    }

    public function hapusistilahiq($id)
    {
        DB::connection('mysqll')->table('core_norm_iq')->where('norm_iq_id',$id)->delete();

	    return redirect('/istilah-iq');
    }

};