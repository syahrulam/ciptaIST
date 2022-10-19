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

class GesamtIstController extends Controller
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
        $gesamt_data =  DB::connection('mysqll')->table('gesamt_data')->get();
        $return = [
            'gesamt_data'
        ];
        return view('content\Gesampt\Gesamt', compact($return));
    }
    public function tambahgesamt()
    {
        return view('content\Gesampt\TambahGesamt');
    }

    public function addprosesgesamt(Request $request)
    {
        $request->validate([
            'totalgeawal'=>'required',
            'totalgeakhir'=>'required',
            'nilaige'=>'required'
        ]);

        $query = DB::connection('mysqll')->table('gesamt_data')->insert([
            'gesamt_age_start'=>$request->input('totalgesamtmulai'),
            'gesamt_age_end'=>$request->input('totalgesamtakhir'),
            'gesamt_total_rw_start'=>$request->input('nilaigesamtmulairw'),
            'gesamt_total_rw_end'=>$request->input('nilaigesamtakhirrw'),
            'gesamt_total_sw'=>$request->input('nilaigesamtsw')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }
};