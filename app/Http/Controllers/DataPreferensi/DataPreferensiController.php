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

    // Start Function Datates

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

    // End Function Data Test
    
    // Start Function hasil test
    public function hasiltesist(){
        $tb_datates = DB::table('tb_datates')->get();
        $return = [
            'tb_datates'
        ];
        return view('content/DataPreferensi/HasilTestIst', compact($return));
    }
    public function tambahhasiltesist(){
        
        return view('content/DataPreferensi/TambahHasilTestIst');
    }

    public function prosestambahhasiltesist(Request $request)
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

    public function detailhasiltesist($id){
        $tb_datates = DB::table('tb_datates')->where('id',$id)->get();
        return view('content/DataPreferensi/DetailHasilTestIst',['tb_datates'=>$tb_datates]);
    }

    public function edithasiltesist($id){

        $tb_datates = DB::table('tb_datates')->where('id',$id)->get();
        return view('content/DataPreferensi/EditHasilTestIst',['tb_datates'=>$tb_datates]);
    }

    public function edithasiltesistproses(Request $request){    
        
	    DB::table('tb_datates')->where('id',$request->id)->update([
            'namaklien'=>$request->namaklien,
            'kategorites'=>$request->kategorites,
            'tipepengguna'=>$request->tipepengguna,
            'tanggalujian'=>$request->tanggalujian,
            'tujuanujian'=>$request->tujuanujian
	]);

	return redirect('/hasiltestist');
    }

    public function hapushasiltest($id)
    {
        DB::table('tb_datates')->where('id',$id)->delete();

	    return redirect('/hasiltestist');
    }

    public function carihasiltestist(Request $request)
	{
		$cari = $request->cari;
 
		$tb_datates = DB::table('tb_datates')
		->where('id','like',"%".$cari."%")
		->paginate();
 
		return view('content/DataPreferensi/HasilTestIst',['tb_datates'=>$tb_datates]);
 
	}
    // End Function Hasil Test
    // Test IST Start Function

    public function tesist(){
        
        return view('content/DataPreferensi/TesIst');
    }

    public function prosestambahtesist(Request $request)
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

    // Test IST End Function

    // Start Function Set User Group

    public function setusergroup(){
        $system_user_group = DB::table('system_user_group')->get();
        $return = [
            'system_user_group'
        ];
        return view('content/DataPreferensi/SetUserGroup', compact($return));
    }
    public function tambahsetusergroup(){
        
        return view('content/DataPreferensi/TambahSetUserGroup');
    }

    public function prosestambahsetusergroup(Request $request)
    {
        $request->validate([
            'tingkatan'=>'required',
            'nama'=>'required'

        ]);

        $query = DB::table('system_user_group')->insert([
            'user_group_level'=>$request->input('tingkatan'),
            'user_group_name'=>$request->input('nama')

        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function detailsetusergroup($id){
        $system_user_group = DB::table('system_user_group')->where('user_group_id',$id)->get();
        return view('content/DataPreferensi/DetailSetUserGroup',['system_user_group'=>$system_user_group]);
    }

    public function editsetusergroup($id){

        $system_user_group = DB::table('system_user_group')->where('user_group_id',$id)->get();
        return view('content/DataPreferensi/EditSetUserGroup',['system_user_group'=>$system_user_group]);
    }

    public function editsetusergroupproses(Request $request){    
        
	    DB::table('system_user_group')->where('user_group_id',$request->id)->update([
            'user_group_level'=>$request->tingkatan,
            'user_group_name'=>$request->nama
	]);

	return redirect('/setusergroup');
    }

    public function hapussetusergroup($id)
    {
        DB::table('system_user_group')->where('user_group_id',$id)->delete();

	    return redirect('/setusergroup');
    }

    public function carisetusergroup(Request $request)
	{
		$cari = $request->cari;
 
		$system_user_group = DB::table('system_user_group')
		->where('user_group_name','like',"%".$cari."%")
		->paginate();
 
		return view('content/DataPreferensi/setusergroup',['system_user_group'=>$system_user_group]);
 
	}
};