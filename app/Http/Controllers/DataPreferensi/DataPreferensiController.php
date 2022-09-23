<?php

namespace App\Http\Controllers\DataPreferensi;

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

class DataPreferensiController extends Controller
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

    public function datates(){
        $tb_datates = DB::table('tb_datates')->get();
        $return = [
            'tb_datates'
        ];
        return view('content/DataPreferensi/DataTes', compact($return));
    }
    public function tambahdatates(){
        
        return view('content/DataPreferensi/TambahDataTes');
    }

    public function prosestambahdatates(Request $request)
    {
        $request->validate([
            'namaklien'=>'required',
            'kategorites'=>'required',
            'tipepengguna'=>'required',
            'tanggalujian'=>'required',
            'tujuanujian'=>'required'

        ]);

        $query = DB::table('tb_datates')->insert([
            'namaklien'=>$request->input('namaklien'),
            'kategorites'=>$request->input('kategorites'),
            'tipepengguna'=>$request->input('tipepengguna'),
            'tanggalujian'=>$request->input('tanggalujian'),
            'tujuanujian'=>$request->input('tujuanujian')

        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function detaildatates($id){
        $tb_datates = DB::table('tb_datates')->where('id',$id)->get();
        return view('content/DataPreferensi/DetailDataTes',['tb_datates'=>$tb_datates]);
    }

    public function editdatates($id){

        $tb_datates = DB::table('tb_datates')->where('id',$id)->get();
        return view('content/DataPreferensi/EditDataTes',['tb_datates'=>$tb_datates]);
    }

    public function editdatatesproses(Request $request){
        
	    DB::table('tb_datates')->where('id',$request->id)->update([
            'namaklien'=>$request->namaklien,
            'kategorites'=>$request->kategorites,
            'tipepengguna'=>$request->tipepengguna,
            'tanggalujian'=>$request->tanggalujian,
            'tujuanujian'=>$request->tujuanujian
	]);

	return redirect('/datates');
    }

    public function hapusdatates($id)
    {
        DB::table('tb_datates')->where('id',$id)->delete();

	    return redirect('/datates');
    }

    public function caridatates(Request $request)
	{
		$cari = $request->cari;
 
		$tb_datates = DB::table('tb_datates')
		->where('id','like',"%".$cari."%")
		->paginate();
 
		return view('content/DataPreferensi/DataTes',['tb_datates'=>$tb_datates]);
 
	}
    // End Function Data tes
   
};