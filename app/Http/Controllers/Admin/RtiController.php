<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RtiMandatoryDisclosureController;
use App\Models\Rti;
use App\Models\RtiMandatoryDisclosure;
use Illuminate\Http\Request;
use AUTH;
use Session;

class RtiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (AUTH::user()->user_type == '3') {
            $mandatory = RtiMandatoryDisclosure::where('unit_id', AUTH::user()->unit_id)->get();
            $website_products  = Rti::where('unit_id', AUTH::user()->unit_id)->get();
            $product_count = $website_products->count();
        } elseif (AUTH::user()->user_type == 9) {
            $mandatory = RtiMandatoryDisclosure::where('unit_id', AUTH::user()->unit_id)->where('status', '!=', '0')->get();
            $website_products  = Rti::where('unit_id', AUTH::user()->unit_id)->where('status', '!=', '0')->get();
            $product_count = $website_products->count();
        }

        return view('rti.list-rti', ['website_products' => $website_products, 'mandatory' => $mandatory, 'product_count' => $product_count]);
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
        $new  = new Rti;
        $new->unit_id = AUTH::user()->unit_id;
        $new->name_of_officer = $request->officer_name;
        $new->designation = $request->designation;
        $new->responsibility_assigned = $request->responsibility_assigned;
        $new->email_address = $request->email_address;
        $new->phone_no = $request->phone_no;
        $new->created_by = AUTH::user()->id;
        $new->save();

        return redirect()->back();
    }

    public function storedisclosure(Request $request)
    {

        if ($request->hasFile('disclosure')) {
            $imageName = time() . '.' . $request->disclosure->extension();
            $imgname =  $request->disclosure->getClientOriginalName();
            $dotcount = substr_count($imgname, ".");
            if ($dotcount == '1') {
                $request->disclosure->move('upload/websitelogo', $imageName);
                $web_logo = 'upload/websitelogo/' . $imageName;
            } else {
                Session::flash('message', 'danger|File Name Must Contain Only One "."');
                // $request->session()->flash('alert-danger', 'File Name Must Contain Only One "."');
                return redirect()->back();
            }
        } else {
            $web_logo = '';
        }

        $new = new RtiMandatoryDisclosure;
        $new->unit_id = AUTH::user()->unit_id;
        $new->en_title = $request->en_title;
        $new->hi_title = $request->hi_title;
        $new->attachment = $web_logo;
        $new->save();
        Session::flash('message', 'success|Data Inserted Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Rti $rti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rti $rti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function updatepoirti(Request $request)
    {

        $live_data = Rti::where('id', $request->poi_hid)->first();
        if ($live_data->live_table_id == 0) {
            Rti::where('id', $request->poi_hid)->update([
                'name_of_officer' => $request->input('name_of_officer'),
                'designation' => $request->input('designation'),
                'phone_no' => $request->input('phone_no'),
                'responsibility_assigned' => $request->input('responsibility_assigned'),
                'created_by' => AUTH::user()->id,
                'email_address' => $request->input('email_address')

            ]);
        } else {
            $new = new Rti;
            $new->unit_id = AUTH::user()->unit_id;
            $new->name_of_officer = $request->name_of_officer;
            $new->designation = $request->designation;
            $new->responsibility_assigned = $request->responsibility_assigned;
            $new->email_address = $request->email_address;
            $new->phone_no = $request->phone_no;
            $new->created_by = AUTH::user()->id;
            $new->save();
        }

        Session::flash('message', 'Success|Data Inserted Successfuly');
        return redirect()->back();
    }

    public function updatemandatory(Request $request){
        if ($request->hasFile('disclosure')) {
            $imageName = time() . '.' . $request->disclosure->extension();
            $imgname =  $request->disclosure->getClientOriginalName();
            $dotcount = substr_count($imgname, ".");
            if ($dotcount == '1') {
                $request->disclosure->move('upload/websitelogo', $imageName);
                $web_logo = 'upload/websitelogo/' . $imageName;
            } else {
                Session::flash('message', 'danger|File Name Must Contain Only One "."');
                return redirect()->back();
            }
        } else {
            $web_logo = $request->update_attachment;
        }
        $live_data = RtiMandatoryDisclosure::where('id', $request->mandatory_hid)->first();
        if ($live_data->live_table_id == 0) {
            RtiMandatoryDisclosure::where('id', $request->mandatory_hid)->update([
                'en_title' => $request->input('en_title'),
                'hi_title' => $request->input('hi_title'),
                'attachment' => $web_logo

            ]);
        } else {
            $new = new RtiMandatoryDisclosure;
            $new->unit_id = AUTH::user()->unit_id;
            $new->en_title = $request->en_title;
            $new->hi_title = $request->hi_title;
            $new->attachment = $web_logo;
            $new->save();
        }

        Session::flash('message', 'Success|Data Inserted Successfuly');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rti $rti)
    {
        //
    }
}
