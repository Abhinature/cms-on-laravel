<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{User, UnitUser, TblIPBlocklist, AuditPassword};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Session;

class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index(Request $request)
    {

        $data = User::orderBy('id', 'DESC')->paginate(5);

        return view('users.index', compact('data'))

            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

  
    public function unitlogin(Request $request){
        $request->validate([
            'password' => 'required',
            'email' => 'required|email',
            'captcha' => 'required|captcha'
        ]);
        $user = array(
            'email' => $request->email,
            'password' => $request->password,
        );
        
        $clientIP = $request->getClientIp(true);
        $ip = TblIPBlocklist::where('fld_ip',$clientIP)->count();
        
        $auditInsertID = AuditPassword::insertGetId([
            'email' => $request->email,
            'ip_address' => $request->ip(),
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // dd($request->all());

        if($ip > 0){
            Session::flash('message', 'danger|Your Access To Application Is Locked Kindly Contact To Administrator !');
            return redirect('login');
        }
        if (session()->has('wrong_attempt')) {
            $a = session('wrong_attempt');
        } else {
            $a = 0;
        }

        if (Auth::attempt($user)) {
            AuditPassword::where('id', $auditInsertID)->update(['status' => 2]);
            UnitUser::where('email', $request->email)->update(['user_token' => date('ymdhis') ]);
            return redirect()->route('home');
        }else{
            
            $a = $a + 1;
            Session::put('wrong_attempt', $a);
            if ($a >= 3) {
                lockAccount($clientIP);
                Session::flash('message', 'danger|Your Access To Application Is Locked Kindly Contact To Administrator !');
                return redirect('login');
            }
            Session::flash('message', 'danger|Invalid Credientials !');
            return redirect('login');
        }

    }

    /**
    
    * Show the form for creating a new resource.
    
    *
    
    * @return \Illuminate\Http\Response
    
    */

    public function create()
    {

        $roles = Role::pluck('name', 'name')->all();

        return view('users.create', compact('roles'));

    }



    /**
    
    * Store a newly created resource in storage.
    
    *
    
    * @param  \Illuminate\Http\Request  $request
    
    * @return \Illuminate\Http\Response
    
    */

    public function store(Request $request)
    {

        $this->validate($request, [

            'name' => 'required',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|same:confirm-password',

            'roles' => 'required'

        ]);



        $input = $request->all();
         $hash = hash('sha512', $input['password']);
        $input['password'] = $hash;



        $user = User::create($input);

        $user->assignRole($request->input('roles'));



        return redirect()->route('users.index')

            ->with('success', 'User created successfully');

    }



    /**
    
    * Display the specified resource.
    
    *
    
    * @param  int  $id
    
    * @return \Illuminate\Http\Response
    
    */

    public function show($id)
    {

        $user = User::find($id);

        return view('users.show', compact('user'));

    }



    /**
    
    * Show the form for editing the specified resource.
    
    *
    
    * @param  int  $id
    
    * @return \Illuminate\Http\Response
    
    */

    public function edit($id)
    {

        $user = User::find($id);

        $roles = Role::pluck('name', 'name')->all();

        $userRole = $user->roles->pluck('name', 'name')->all();



        return view('users.edit', compact('user', 'roles', 'userRole'));

    }



    /**
    
    * Update the specified resource in storage.
    
    *
    
    * @param  \Illuminate\Http\Request  $request
    
    * @param  int  $id
    
    * @return \Illuminate\Http\Response
    
    */

    public function update(Request $request, $id)
    {

        $this->validate($request, [

            'name' => 'required',

            'email' => 'required|email|unique:users,email,' . $id,

            'password' => 'same:confirm-password',

            'roles' => 'required'

        ]);



        $input = $request->all();

        if (!empty($input['password'])) {
            $hash = hash('sha512', $input['password']);
            $input['password'] = $hash;
            // $input['password'] = Hash::make($input['password']);

        } else {

            $input = Arr::except($input, array('password'));

        }



        $user = User::find($id);

        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();



        $user->assignRole($request->input('roles'));



        return redirect()->route('users.index')

            ->with('success', 'User updated successfully');

    }



    /**
    
    * Remove the specified resource from storage.
    
    *
    
    * @param  int  $id
    
    * @return \Illuminate\Http\Response
    
    */

    public function destroy($id)
    {

        User::find($id)->delete();

        return redirect()->route('users.index')

            ->with('success', 'User deleted successfully');

    }
}