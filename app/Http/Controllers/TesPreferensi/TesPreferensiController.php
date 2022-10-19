<?php

namespace App\Http\Controllers\TesPreferensi;

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
use App\Models\Pertanyaan;
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

class TesPreferensiController extends Controller
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

    // Start Function Pertanyaan
    public function pertanyaan(){

        $categories = DB::table('categories')->get();
        $questions = DB::table('questions')->get();
        $return = [
            'categories',
            'questions',
        ];

        // $core_ist = DB::connection('mysqll')->table('core_ist')->get();
        // $core_question = DB::connection('mysqll')->table('core_question')->get();
        // $core_question_answer = DB::connection('mysqll')->table('core_question_answer')->get();
        // $return = [
        //     'core_ist',
        //     'core_question',
        //     'core_question_answer',
        // ];
        return view('content/TesPreferensi/Pertanyaan', compact($return));
    }

    public function tambahpertanyaan(){
        
        return view('content/TesPreferensi/TambahPertanyaan');
    }

    public function prosestambahpertanyaan(Request $request)
    {
        $request->validate([
            'kodeIST'=>'required',
            'nomorPertanyaan'=>'required',
            'komentarPertanyaan'=>'required',
            'pertanyaan'=>'required'
            
        ]);

        $query1 =DB::connection('mysqll')->table('core_ist')->insert([
            'ist_code'=>$request->input('kodeIST')

        ]);
        
        $query2 =DB::connection('mysqll')->table('core_question')->insert([
            'question_no'=>$request->input('nomorPertanyaan'),
            'question_remark'=>$request->input('komentarPertanyaan'),
            'question_title'=>$request->input('pertanyaan')

        ]);
    }

    public function detailPertanyaan($id){

        // DB::table('trx_bookingkursi')
        //     ->select('trx_bookingkursi.*', 'ref_direktorat.nama as direktorat', 'ref_fungsi.nama as fungsi', 'm_kursi.kode as kodeKursi', 'm_kursi.nama')
        //     ->join('ref_direktorat', 'ref_direktorat.ID', 'trx_bookingkursi.direktorat')
        //     ->join('ref_fungsi', 'ref_fungsi.ID', 'trx_bookingkursi.fungsi')
        //     ->join('m_kursi', 'm_kursi.ID', 'trx_bookingkursi.kursi')
        //     ->where('trx_bookingkursi.ID', $id)
        //     ->get();

        $core_ist = DB::connection('mysqll')->table('core_question')
            ->select('core_question.*', 'core_ist.ist_nama as coreist')
            ->join('core_ist', 'core_ist.ist_id', 'core_question.ist_nama')
            ->where('core_question.question_id', $id)
            ->get();

            $return = ['core_ist'];

            return view('content/TesPreferensi/DetailPertanyaan', compact($return));

        // $core_ist = DB::connection('mysqll')->table('core_ist')->where('ist_id',$id)->get();
        // $core_question = DB::connection('mysqll')->table('core_question')->where('question_id',$id)->get();
        // $core_question_answer = DB::connection('mysqll')->table('core_question_answer')->where('question_id',$id)->get();
        // $return = [
        //     'core_ist',
        //     'core_question',
        //     'core_question_answer',
        // ];

        
        // $tb_pertanyaan = DB::table('tb_pertanyaan')->where('ID',$id)->get();
        // return view('content/TesPreferensi/DetailPertanyaan',['tb_pertanyaan'=>$tb_pertanyaan]);
        
        // $core_question_answer = DB::connection('mysqll')->table('core_question_answer')->where('question_id',$id)->get();
        // return view('content/TesPreferensi/DetailPertanyaan',['core_question_answer'=>$core_question_answer]);
    }

    public function editPertanyaan($id){

        $tb_pertanyaan = DB::table('tb_pertanyaan')->where('ID',$id)->get();
        return view('content/TesPreferensi/EditPertanyaan',['tb_pertanyaan'=>$tb_pertanyaan]);
    }

    public function editPertanyaanProses(Request $request){

	    DB::table('tb_pertanyaan')->where('ID',$request->id)->update([
            'kodeIST'=>$request->kodeist,
            'nomorPertanyaan'=>$request->nopertanyaan,
            'komentarPertanyaan'=>$request->komenpertanyaan,
            'pertanyaan'=>$request->pertanyaan
	]);

	return redirect('/pertanyaan');
    }

    public function hapusPertanyaan($id)
    {
        DB::table('tb_pertanyaan')->where('ID',$id)->delete();

	    return redirect('/pertanyaan');
    }

    public function caripertanyaan(Request $request)
	{
		$cari = $request->cari;
        $core_ist = DB::connection('mysqll')->table('core_ist')
		->where('ist_code','like',"%".$cari."%")
		->paginate();
 
		return view('content/TesPreferensi/Pertanyaan',['core_ist'=>$core_ist]);
 
	}

    // End Function Pertanyaan

    // Start Type User Function
    public function user(){
        $system_user_group = DB::connection('mysqll')->table('system_user_group')->get();
        $return = [
            'system_user_group'
        ];
        return view('content/TesPreferensi/TipeUser', compact($return));
    }

    public function tambahuser(){

        return view('content/TesPreferensi/TambahTipeUser');
    }
    
    public function addprosesuser(Request $request)
    {
        $request->validate([
            'namatipeuser'=>'required'
        ]);

        $query = DB::connection('mysqll')->table('system_user_group')->insert([
            'user_group_name'=>$request->input('namatipeuser')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function edituser($id){

        $system_user_group = DB::connection('mysqll')->table('system_user_group')->where('user_group_id',$id)->get();
        return view('content/TesPreferensi/EditTipeUser',['system_user_group'=>$system_user_group]);
    }

    public function edituserproses(Request $request){

	    DB::connection('mysqll')->table('system_user_group')->where('user_group_id',$request->id)->update([
            'user_group_name'=>$request->namatipeuser
	]);

	return redirect('/user');
    }

    public function hapususer($id)
    {
        DB::connection('mysqll')->table('system_user_group')->where('user_group_id',$id)->delete();

	    return redirect('/user');
    }

    public function cariuser(Request $request)
	{
		$cari = $request->cari;
 
		$system_user_group = DB::connection('mysqll')->table('system_user_group')
		->where('user_group_name','like',"%".$cari."%")
		->paginate();
 
		return view('content/TesPreferensi/TipeUser',['system_user_group'=>$system_user_group]);
 
	}

    // End Type User Function

    // Start edukasi Function

    public function edukasi(){
        $core_education = DB::connection('mysqll')->table('core_education')->get();
        $return = [
            'core_education'
        ];
        return view('content/TesPreferensi/Edukasi', compact($return));
    }

    public function tambahedukasi(){

        return view('content/TesPreferensi/TambahEdukasi');
    }
    
    public function addprosesedukasi(Request $request)
    {
        $request->validate([
            'namaedukasi'=>'required'
        ]);
        $query = DB::connection('mysqll')->table('core_education')->insert([
            'education_name'=>$request->input('namaedukasi')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editedukasi($id){

        $core_education = DB::connection('mysqll')->table('core_education')->where('education_id',$id)->get();
        return view('content/TesPreferensi/EditEdukasi',['core_education'=>$core_education]);
    }

    public function editedukasiproses(Request $request){

	    DB::connection('mysqll')->table('core_education')->where('id',$request->id)->update([
            'education_name'=>$request->namaedukasi
	]);
    

	return redirect('/edukasi');
    }

    public function hapusedukasi($id)
    {
        DB::connection('mysqll')->table('core_education')->where('education_id',$id)->delete();

	    return redirect('/edukasi');
    }

    public function cariedukasi(Request $request)
	{
		$cari = $request->cari;
 
		$tb_edukasi = DB::connection('mysqll')->table('core_education')
		->where('namaedukasi','like',"%".$cari."%")
		->paginate();
 
		return view('content/TesPreferensi/Edukasi',['tb_edukasi'=>$tb_edukasi]);
 
	}

    // End Edukasi Function
    
        
    // Start kategori Function

    public function kategori(){
        $core_test_category = DB::connection('mysqll')->table('core_test_category')->get();
        $return = [
            'core_test_category'
        ];
        return view('content/TesPreferensi/KategoriUjian', compact($return));
    }

    public function tambahkategori(){

        return view('content/TesPreferensi/TambahKategoriUjian');
    }
    
    public function addproseskategori(Request $request)
    {
        $request->validate([
            'namakategori'=>'required'
        ]);

        $query = DB::connection('mysqll')->table('core_test_category')->insert([
            'test_category_name'=>$request->input('namakategori')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editkategori($id){

        $core_test_category = DB::connection('mysqll')->table('core_test_category')->where('test_category_id',$id)->get();
        
        return view('content/TesPreferensi/EditKategori',['core_test_category'=>$core_test_category]);
    }

    public function editkategoriproses(Request $request){

	    DB::connection('mysqll')->table('core_test_category')->where('test_category_id',$request->id)->update([
            'test_category_name'=>$request->namakategori
	]);
    

	return redirect('/kategori-ujian');
    }

    public function hapuskategori($id)
    {
        DB::connection('mysqll')->table('core_test_category')->where('test_category_id',$id)->delete();

	    return redirect('/kategori-ujian');
    }

    public function carikategori(Request $request)
	{
		$cari = $request->cari;
 
		$core_test_category = DB::connection('mysqll')->table('core_test_category')
		->where('test_category_name','like',"%".$cari."%")
		->paginate();
 
		return view('content/TesPreferensi/KategoriUjian',['core_test_category'=>$core_test_category]);
 
	}

    // End kategori Function
    
    // Start klien Function

    
    public function klien(){
        $core_client = DB::connection('mysqll')->table('core_client')->get();
        $return = [
            'core_client'
        ];
        return view('content/TesPreferensi/Klien', compact($return));
    }

    public function tambahklien(){

        return view('content/TesPreferensi/TambahKlien');
    }
    
    public function addprosesklien(Request $request)
    {
        $request->validate([
            'namaklien'=>'required',
            'nomorklien'=>'required',
            'nomorkliendua'=>'required',
            'nomorrumah'=>'required',
            'kontakperson'=>'required'
        ]);

        $query = DB::connection('mysqll')->table('core_client')->insert([
            'client_name'=>$request->input('namaklien'),
            'client_mobile_phone1'=>$request->input('nomorklien'),
            'client_mobile_phone2'=>$request->input('nomorkliendua'),
            'client_home_phone'=>$request->input('nomorrumah'),            
            'client_contact_person'=>$request->input('kontakperson')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editklien($id){

        $core_client = DB::connection('mysqll')->table('core_client')->where('client_id',$id)->get();
        return view('content/TesPreferensi/EditKlien',['core_client'=>$core_client]);
    }

    public function editklienproses(Request $request){

	    DB::connection('mysqll')->table('core_client')->where('client_id',$request->id)->update([
            'client_name'=>$request->namaklien,
            'client_mobile_phone1'=>$request->nomorklien,
            'client_mobile_phone2'=>$request->nomorkliendua,
            'client_home_phone'=>$request->nomorrumah,            
            'client_contact_person'=>$request->kontakperson
	]);
    

	return redirect('/klien');
    }

    public function hapusklien($id)
    {
        DB::connection('mysqll')->table('core_client')->where('client_id',$id)->delete();

	    return redirect('/klien');
    }

    public function cariklien(Request $request)
	{
		$cari = $request->cari;
 
		$core_client = DB::connection('mysqll')->table('core_client')
		->where('client_name','like',"%".$cari."%")
		->paginate();
 
		return view('content/TesPreferensi/Klien',['core_client'=>$core_client]);
 
	}

    // End klien Function
   
};