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
        $tb_pertanyaan = DB::table('tb_pertanyaan')->get();
        $return = [
            'tb_pertanyaan'
        ];
        return view('content/TesPreferensi/Pertanyaan', compact($return));
    }
    public function tambahpertanyaan(){
        
        return view('content/TesPreferensi/TambahPertanyaan');
    }

    public function prosestambahpertanyaan(Request $request)
    {
        $request->validate([
            'kodeist'=>'required',
            'nopertanyaan'=>'required',
            'komentarpertanyaan'=>'required',
            'pertanyaan'=>'required'

        ]);

        $query = DB::table('tb_pertanyaan')->insert([
            'kodeIST'=>$request->input('kodeist'),
            'nomorPertanyaan'=>$request->input('nopertanyaan'),
            'komentarPertanyaan'=>$request->input('komentarpertanyaan'),
            'pertanyaan'=>$request->input('pertanyaan')

        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function detailPertanyaan($id){
        $tb_pertanyaan = DB::table('tb_pertanyaan')->where('ID',$id)->get();
        return view('content/TesPreferensi/DetailPertanyaan',['tb_pertanyaan'=>$tb_pertanyaan]);
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
 
		$tb_pertanyaan = DB::table('tb_pertanyaan')
		->where('ID','like',"%".$cari."%")
		->paginate();
 
		return view('content/TesPreferensi/Pertanyaan',['tb_pertanyaan'=>$tb_pertanyaan]);
 
	}
    // End Function Pertanyaan

    // Start Type User Function
    public function user(){
        $system_user_group = DB::table('system_user_group')->get();
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

        $query = DB::table('system_user_group')->insert([
            'user_group_name'=>$request->input('namatipeuser')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function edituser($id){

        $system_user_group = DB::table('system_user_group')->where('user_group_id',$id)->get();
        return view('content/TesPreferensi/EditTipeUser',['system_user_group'=>$system_user_group]);
    }

    public function edituserproses(Request $request){

	    DB::table('system_user_group')->where('user_group_id',$request->id)->update([
            'user_group_name'=>$request->namatipeuser
	]);

	return redirect('/user');
    }

    public function hapususer($id)
    {
        DB::table('system_user_group')->where('user_group_id',$id)->delete();

	    return redirect('/user');
    }

    public function cariuser(Request $request)
	{
		$cari = $request->cari;
 
		$system_user_group = DB::table('system_user_group')
		->where('user_group_name','like',"%".$cari."%")
		->paginate();
 
		return view('content/TesPreferensi/TipeUser',['system_user_group'=>$system_user_group]);
 
	}

    // End Type User Function

    // Start edukasi Function

    public function edukasi(){
        $tb_edukasi = DB::table('tb_edukasi')->get();
        $return = [
            'tb_edukasi'
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

        $query = DB::table('tb_edukasi')->insert([
            'namaedukasi'=>$request->input('namaedukasi')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editedukasi($id){

        $tb_edukasi = DB::table('tb_edukasi')->where('id',$id)->get();
        return view('content/TesPreferensi/EditEdukasi',['tb_edukasi'=>$tb_edukasi]);
    }

    public function editedukasiproses(Request $request){

	    DB::table('tb_edukasi')->where('id',$request->id)->update([
            'namaedukasi'=>$request->namaedukasi
	]);
    

	return redirect('/edukasi');
    }

    public function hapusedukasi($id)
    {
        DB::table('tb_edukasi')->where('id',$id)->delete();

	    return redirect('/edukasi');
    }

    public function cariedukasi(Request $request)
	{
		$cari = $request->cari;
 
		$tb_edukasi = DB::table('tb_edukasi')
		->where('namaedukasi','like',"%".$cari."%")
		->paginate();
 
		return view('content/TesPreferensi/Edukasi',['tb_edukasi'=>$tb_edukasi]);
 
	}

    // End Edukasi Function
    
        
    // Start kategori Function

    public function kategori(){
        $tb_kategori = DB::table('tb_kategori')->get();
        $return = [
            'tb_kategori'
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

        $query = DB::table('tb_kategori')->insert([
            'namakategori'=>$request->input('namakategori')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editkategori($id){

        $tb_kategori = DB::table('tb_kategori')->where('id',$id)->get();
        
        return view('content/TesPreferensi/EditKategori',['tb_kategori'=>$tb_kategori]);
    }

    public function editkategoriproses(Request $request){

	    DB::table('tb_kategori')->where('id',$request->id)->update([
            'namakategori'=>$request->namakategori
	]);
    

	return redirect('/kategori-ujian');
    }

    public function hapuskategori($id)
    {
        DB::table('tb_kategori')->where('id',$id)->delete();

	    return redirect('/kategori-ujian');
    }

    public function carikategori(Request $request)
	{
		$cari = $request->cari;
 
		$tb_kategori = DB::table('tb_kategori')
		->where('namakategori','like',"%".$cari."%")
		->paginate();
 
		return view('content/TesPreferensi/KategoriUjian',['tb_kategori'=>$tb_kategori]);
 
	}

    // End kategori Function
    
    // Start klien Function

    
    public function klien(){
        $tb_klien = DB::table('tb_klien')->get();
        $return = [
            'tb_klien'
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

        $query = DB::table('tb_klien')->insert([
            'namaklien'=>$request->input('namaklien'),
            'nomorklien'=>$request->input('nomorklien'),
            'nomorkliendua'=>$request->input('nomorkliendua'),
            'nomorrumah'=>$request->input('nomorrumah'),            
            'kontakperson'=>$request->input('kontakperson')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editklien($id){

        $tb_klien = DB::table('tb_klien')->where('id',$id)->get();
        return view('content/TesPreferensi/EditKlien',['tb_klien'=>$tb_klien]);
    }

    public function editklienproses(Request $request){

	    DB::table('tb_klien')->where('id',$request->id)->update([
            'namaklien'=>$request->namaklien
	]);
    

	return redirect('/Klien');
    }

    public function hapusklien($id)
    {
        DB::table('tb_klien')->where('id',$id)->delete();

	    return redirect('/Klien');
    }

    public function cariklien(Request $request)
	{
		$cari = $request->cari;
 
		$tb_klien = DB::table('tb_klien')
		->where('namaklien','like',"%".$cari."%")
		->paginate();
 
		return view('content/TesPreferensi/Klien',['tb_klien'=>$tb_klien]);
 
	}

    // End klien Function
   
};