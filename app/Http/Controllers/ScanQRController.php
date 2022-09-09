<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScanQRController extends Controller
{
    public function index()
    {

        $getMessages = DB::table('core_messages')->get();
        $return = [
            'getMessages'
        ];
        return view('content/DataPreferensi/DataTes', compact($return));
    }

    public function showdatatest()
    {

    }
}