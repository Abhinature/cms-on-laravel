<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class OtpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sendotp(Request $request){
        $otp = mt_rand(100000,999999);       
        $mm = new OTP;
        $mm->otp = $otp;
        $mm->otp_for = $request->rel;
        $mm->user_id = Auth::user()->id;
        
        if($mm->save()){
            return response()->json(['success' => true,'otp'=>$otp]);
            // return json_encode(array('success' => true), 200);
        }else{
            return response()->json(['success' => false]);
        }

    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Otp $otp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Otp $otp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Otp $otp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Otp $otp)
    {
        //
    }
}
