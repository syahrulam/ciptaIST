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
        $getIst = DB::table('trans_service_requisition')->get();
        $return = [
            'getIst'
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

        $query = DB::table('trans_service_requisition')->insert([
            'service_requisition_no'=>$request->input('kodeist'),
            'service_requisition_name'=>$request->input('namaist'),
            'delete_remark'=>$request->input('durasiist'),
            'service_requisition_status'=>$request->input('deskripsiist')
        ]);

        if($query){

            return back()->with('success', 'Data berhasil ditambahkan');
         }else{
            return back()->with('fail', 'Data gagal ditambahkan');
         }
    }

    public function editist($id)
    {
        $data = TransServiceRequisition::find($id);
        // dd($data); 

        return view('content\IST\EditIst', compact('data'));
    }

        public function editistprosess($id)
    {
        $data = TransServiceRequisition::find($id);
        $data->update($request->all());
        // dd($data); 

        return redirect()->route('ist');
    }

    public function deleteist($id)
    {
        $data = TransServiceRequisition::find($id);
        $data->delete();
    }
};