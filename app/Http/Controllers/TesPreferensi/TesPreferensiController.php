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
    public function pertanyaan(){
        $getPertanyaan = DB::table('tb_pertanyaan')->get();
        $return = [
            'getPertanyaan'
        ];
        return view('content/TesPreferensi/Pertanyaan', compact($return));
    }

    public function detailPertanyaan($id){
        $getDetailPertanyaan = DB::table('tb_pertanyaan')->get();
        $return = [
            'getDetailPertanyaan'
        ];
        return view('content/TesPreferensi/DetailPertanyaan', compact($return));
    }

    public function editPertanyaan(){
        $getIst = DB::table('tb_ist')->get();
        $return = [
            'getIst'
        ];
        return view('content/TesPreferensi/editPertanyaan', compact($return));
    }

    public function user(){
        $getIst = DB::table('tb_ist')->get();
        $return = [
            'getIst'
        ];
        return view('content/TesPreferensi/TipeUser', compact($return));
    }

    
    public function edituser(){

        return view('content/TesPreferensi/EditTipeUser');
    }

    public function edukasi(){
        $getIst = DB::table('tb_ist')->get();
        $return = [
            'getIst'
        ];
        return view('content/TesPreferensi/Edukasi', compact($return));
    }
        
    public function kategoriUjian(){
        $getIst = DB::table('tb_ist')->get();
        $return = [
            'getIst'
        ];
        return view('content/TesPreferensi/KategoriUjian', compact($return));
    }
    
    public function klien(){
        $getIst = DB::table('tb_ist')->get();
        $return = [
            'getIst'
        ];
        return view('content/TesPreferensi/Klien', compact($return));
    }
   
};