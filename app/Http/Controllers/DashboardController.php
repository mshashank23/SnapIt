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

        $result = DB::select("SELECT COUNT(*) as total, stages FROM opportunities,sales_stages WHERE opportunities.salesid=sales_stages.salesid GROUP BY opportunities.salesid, stages");
        
        $result2 = DB::select("SELECT COUNT(*) as total, name FROM opportunities,users WHERE opportunities.userId=users.id GROUP BY userId,name");

        $chartdata = "";
        $chartdata2= "";
        foreach($result as $list){
            $chartdata.="['".$list->stages."', ".$list->total."],";
        }

        foreach($result2 as $list){
            $chartdata2.="['".$list->name."', ".$list->total."],";
        }
        $arr['chartdata']=rtrim($chartdata, ",");
        $arr['chartdata2']=rtrim($chartdata2, ",");
        return view('admin.dashboard',['opportunities'=>$data, 'zero'=>$data3, 'business'=>$data4], $arr);
    }
}
