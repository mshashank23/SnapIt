<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Opportunity;

class DashboardController extends Controller
{
    public function dashboard(){
        $data = Opportunity::all();
        $data3 = DB::table('opportunities')->where('salesid', '6')->get();
        $data4 = DB::table('opportunities')->where('salesid', '!=', '6')->get();
        return view('admin.dashboard', ['opportunities'=>$data, 'zero'=>$data3, 'business'=>$data4]);
    }
}
