<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\UnitUser;
use App\Models\{Unit, AuditPassword};
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\UnitUserCreatedEmail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\DataTables\UsersDataTable;
use Log;
class UnitUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        $passwordHistory = AuditPassword::where('email', Auth::user()->email)->get();
        
        return $dataTable->render('unit-user.list', compact('passwordHistory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unit = Unit::where('status',1)->get();
        return view('unit-user.add')->with(['unit'=>$unit]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = UnitUser::select()->where('email',$request->input('email'))->first();

        if(empty($data)){
            $hash = Hash::make($request->input('password'));
            $unit = new UnitUser; 
            $unit->unit_id = $request->input('unit_id'); 
            $unit->user_type = $request->input('user_type'); 
            $unit->email = $request->input('email'); 
            $unit->password = $hash; 
            $unit->unit_id = $request->input('unit_id'); 
            $unit->created_by = Auth::user()->id;
            $unit->save();

            $url = URL::temporarySignedRoute(
                'unit-user-password',
                now()->addMinutes(30),
                ['user' => $unit->id]
            );

            Mail::to($unit->email)->send(new UnitUserCreatedEmail($unit, $url));


            return redirect('users')->with(['msg'=>'User Created Successfully']);
        }else{
            return redirect()->back()->with(['msg'=>'Email Already Exists !!']);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(UnitUser $unitUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitUser $unitUser,$id)
    {
        $unit = Unit::where('status',1)->get();
        $id = Crypt::decrypt($id);
        $data = UnitUser::where('id',$id)->first();
        
       return view('unit-user.edit')->with(['data'=>$data,'unit'=>$unit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitUser $unitUser)
    {
        $check = UnitUser::select()->where('email',$request->input('email'))->first();        
        if(empty($check)){         
            UnitUser::where('id',Crypt::decrypt($request->input('hid')))->update([
                'unit_id' => $request->input('unit_id'),
                'user_type' => $request->input('user_type'),
                'email' => $request->input('email'),

            ]);
            return redirect('users')->with(['msg'=>'Data Updated Successfully !!']);
        }else{          
            return redirect()->back()->with(['error'=>'Email Already Exists!!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitUser $unitUser)
    {
        //
    }

    # Password related changes
    public function unitUserSignIn(Request $request) {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $user = UnitUser::findOrFail($request->user);

        if( !empty($user) ) {
            return redirect()->route('change-unit-password', ['id' => base64_encode($user->id)]);
        }
    }

    public function changeUnitPassword(Request $request, $id) {
        return view('auth.passwords.change-password')->with(['userId' => $id]);
    }

    public function changeUnitPasswordPost(Request $request) {

        $request->validate([
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);
        
        $user_id = base64_decode($request->userId);
        $user = UnitUser::where('id', $user_id)->first();

        if( !empty($user) ) {
            $password = Hash::make($request->input('password'));
            
            if(userPasswordAlreadyUsed($user_id, $password)) {
                
                Session::flash('message', 'danger|You had already used this password !');
                return redirect()->back();
            }

            $user->password = $password;
            $user->password_changed_at = Carbon::now()->toDateTimeString();
            $user->save();
            Session::flash('message', 'danger|Password changed successfullu !');
            return redirect()->route('login');
        }

        
    }

    # End Password related changes

    function passHistory(Request $request) {
        try {

            if( !empty($request->id) ) {
                $id = Crypt::decrypt($request->id);
                $user = UnitUser::find($id);
                $passwordHistory = AuditPassword::where('email', $user->email)->latest('created_at')->get();
                $html = view('unit-user.password-history')->with(['passwordHistory' => $passwordHistory])->render();
                
                if( !empty($html) ) {
                    return response()->json([
                        'status' => 200,
                        'html' => $html
                    ]);
                }
                
            }
            return response()->json([
                'status' => 200,
                'html' => 'No record found'
            ]);

        } catch (\Exception $ex) {
            Log::info('Password History Related Issue');
            Log::info($ex->getMessage());
            Log::info('Password History Related Issue End');
        }
    }
}