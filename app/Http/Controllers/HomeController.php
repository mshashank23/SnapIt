<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Opportunity;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Product;
use App\Models\Sales_stage;
use App\Models\Lead_generation;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        $uid=($request->user()->id);
        $data2 = DB::table('opportunities')->where('userId', $uid)->get();
        $data3 = DB::table('opportunities')->where('userId', $uid)->where('salesid', '6')->get();
        $data4 = DB::table('opportunities')->where('userId', $uid)->where('salesid', '!=', '6')->get();
        return view('home', ['opportunities'=>$data2, 'zero_business'=>$data3, 'nonzero_business'=>$data4]);
    }

    public function add()
    {
        $data = Hotel::all();
        $data2 = Product::all();
        $data3 = Sales_stage::all();
        $data4 = Lead_generation::all();
        return view('opportunity', ['hotels'=>$data,'products'=>$data2,'sales'=>$data3, 'leads'=>$data4]);
    }

    function store(Request $request){
        // print_r($request->all());
         $date = $request->date;
         $uid = $request->user()->id;
         $contact_person_name = $request->contact_person;
         $contact_person_email = $request->contact_person_email;
         $contact_person_number = $request->contact_person_number;
         $contact_designation = $request->contact_designation;
         $company_name = $request->company_name;
         $sales_activity = $request->sales_activity;
         $activity_forecasting = $request->activity_forecasting;
         $hotel = $request->hotel;
         $product = $request->product;
         $sale = $request->sale;
         $lead = $request->lead;
         $remarks = $request->remarks;
         $revenue = $request->revenue;

         $p = new \App\Models\Opportunity;
         $p -> date = $date;
         $p -> userId = $uid;
         $p -> contact_person_name = $contact_person_name;
         $p -> contact_person_email = $contact_person_email;
         $p -> contact_person_number = $contact_person_number;
         $p -> contact_designation = $contact_designation;
         $p -> company_name = $company_name;
         $p -> pid = $product;
         $p -> hid = $hotel;
         $p -> sales_activity = $sales_activity;
         $p -> activity_forecasting = $activity_forecasting;
         $p -> salesid = $sale;
         $p -> lead_id = $lead;
         $p -> remarks = $remarks;
         $p -> expected_revenue = $revenue;

         $p->save();
        
         Alert::success('Opportunity added successfully!');
        
         return redirect()->route('home');
    }

    public function remove($id){
        $opportunity = \App\Models\Opportunity::find($id);
        $opportunity->delete();

        Alert::success('Opportunity deleted successfully!');
        return redirect()->route('home');
    }

    public function edit($id){
        $opportunity = \App\Models\Opportunity::find($id);
        $data = Hotel::all();
        $data2 = Product::all();
        $data3 = Sales_stage::all();
        $data4 = Lead_generation::all();
        return view('edit',compact('opportunity'), ['hotels'=>$data,'products'=>$data2,'sales'=>$data3, 'leads'=>$data4]);
    }


    public function update(Request $request, $id){
        $date = $request->date;
        $uid = $request->user()->id;
        $contact_person_name = $request->contact_person;
        $contact_person_email = $request->contact_person_email;
        $contact_person_number = $request->contact_person_number;
        $contact_designation = $request->contact_designation;
        $company_name = $request->company_name;
        $sales_activity = $request->sales_activity;
        $activity_forecasting = $request->activity_forecasting;
        $hotel = $request->hotel;
        $product = $request->product;
        $sale = $request->sale;
        $lead = $request->lead;
        $remarks = $request->remarks;
        $revenue = $request->revenue;

        $p = \App\Models\Opportunity::find($id);
        $p -> date = $date;
        $p -> userId = $uid;
        $p -> contact_person_name = $contact_person_name;
        $p -> contact_person_email = $contact_person_email;
        $p -> contact_person_number = $contact_person_number;
        $p -> contact_designation = $contact_designation;
        $p -> company_name = $company_name;
        $p -> pid = $product;
        $p -> hid = $hotel;
        $p -> sales_activity = $sales_activity;
        $p -> activity_forecasting = $activity_forecasting;
        $p -> salesid = $sale;
        $p -> lead_id = $lead;
        $p -> remarks = $remarks;
        $p -> expected_revenue = $revenue;

        $p->update();
       
        Alert::success('Opportunity updated successfully!');
       
        return redirect()->route('home');
    }



}
