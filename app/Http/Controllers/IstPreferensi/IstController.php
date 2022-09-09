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
        $getIst = DB::table('tb_ist')->get();
        $return = [
            'getIst'
        ];
        return view('content/IST/IstHal', compact($return));
    }
    public function tambahist()
    {
        $coreservice = CoreService::where('data_state', 0)
        ->get();

        return view('content/IST/TambahIstBaru',compact('coreservice'));
    }

    public function addproses()
    {
        $data = json_decode($_POST['datanya']);
        $kodeIst = $data->kodeIst;
        $namaIst = $data->namaIst;
        $durasiIst = $data->durasiIst;
        $deskripsiIst = $data->deskripsiIst;

        $insertData = [
            'kodeIst' => $kodeIst,
            'namaIst' => $namaIst,
            'durasiIst' => $durasiIst,
            'deskripsiIst' => $deskripsiIst
        ];

        $action = DB::table('tb_ist')->insert($insertData);
        if ($action) {
            $notif = [
                'status' => 'success',
                'message' => 'Save data success!',
                'alert' => 'success'
            ];
            echo json_encode($notif);
            return;
        } else {
            $notif = [
                'status' => 'warning',
                'message' => 'Save data failed!',
                'alert' => 'warning'
            ];
            echo json_encode($notif);
            return;
        }
    }

    public function editist()
    {
        return view('content/IST/TambahIstBaru');
    }
};