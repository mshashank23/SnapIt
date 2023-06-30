<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Auth, Alert;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Opportunity;

class AdminController extends Controller
{
    public function authenticate(Request $request){
        
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['email'=>$request->email, 'password' => $request->password], $request->get('remember'))){
            return redirect()->route('admin.dashboard');
        }else{
            session()->flash('error','Login details incorrect.');
            return back()->withInput($request->only('email'));
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    function show(){
        $data = User::all();
        return view('admin.users', ['users'=>$data]);
    }

    function create(){
        return view('admin.addusers');
    }

    function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $p = new \App\Models\User;
        $p -> name = $name;
        $p -> email = $email;
        $p -> password = $password;

        $p->save();
        
        Alert::success('User added successfully!');
        
        return redirect()->route('admin.users');
    }

    public function remove($id){
        $users = \App\Models\User::find($id);
        $users->delete();

        Alert::success('User deleted successfully!');
        return redirect()->route('admin.users');
    }

    public function edit($id){
        $users = \App\Models\User::find($id);
        return view('admin.edit', compact('users'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $users = \App\Models\User::find($id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = $request->input('password');
        $users->update();
        Alert::success('User updated successfully!');
        return redirect()->route('admin.users');
    }

    function opportunity(){
        $data = DB::table('opportunities')
            ->join('users', 'opportunities.userId', '=', 'users.id')
            ->select('opportunities.*', 'users.name')
            ->get();
        return view('admin.opportunity', ['opportunities'=>$data]);
    }

    function reports(){
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
        
        return view('admin.reports',$arr);
    }
}
