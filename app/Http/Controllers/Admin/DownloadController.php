<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use AUTH;
use Session;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        if (AUTH::user()->user_type == '3') {
            $mandatory = Download::where('unit_id', AUTH::user()->unit_id)->where('status', '!=', '10')->latest('id')->get();
            $product_count = $mandatory->count();
        } elseif (AUTH::user()->user_type == 9) {
            $mandatory = Download::where('unit_id', AUTH::user()->unit_id)->whereNotIn('status',['0','10'])->latest('id')->get();
            
            $product_count = $mandatory->count();
        }

        return view('download.list-download', ['mandatory' => $mandatory, 'product_count' => $product_count]);
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

        $new = new Download;
        $new->unit_id = AUTH::user()->unit_id;
        $new->en_category = $request->en_category;
        $new->en_subject = $request->en_subject;
        $new->hi_category = $request->hi_category;
        $new->hi_subject = $request->hi_subject;
        $new->created_by = AUTH::user()->id;
        $new->document = $web_logo;
        $new->save();
        Session::flash('message', 'success|Data Inserted Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Download $download)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $dataaa = Download::where('id', $id)->first();
        if (!empty($dataaa)) {
            $html = view('backend_component.edit-download')->with(['dataaa' => $dataaa])->render();
            return response()->json([
                'status'=> 200,
                'html' => $html
            ]);
        
        }

        return response()->json([
            'status'=> 200,
            'html' => ''
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
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
                return redirect()->back();
            }
        } else {
            $web_logo = $request->update_attachment;
        }
        $live_data = Download::where('id', $request->download_hid)->first();
        if ($live_data->live_table_id == 0 || ($live_data->status != '1')) {
            Download::find($request->download_hid)->update([
                "en_category" => $request->en_category,
                "en_subject" => $request->en_subject,
                "hi_category" => $request->hi_category,
                "hi_subject" => $request->hi_subject,
                "created_by" => AUTH::user()->id,
                "status" => 0,
                "document" => $web_logo

            ]);
        } else {
            $new = new Download;
            $new->unit_id = AUTH::user()->unit_id;
            $new->en_category = $request->en_category;
            $new->en_subject = $request->en_subject;
            $new->hi_category = $request->hi_category;
            $new->hi_subject = $request->hi_subject;
            $new->created_by = AUTH::user()->id;
            $new->document = $web_logo;
            $new->live_table_id = $live_data->live_table_id;
            $new->type = '1';
            $new->save();
        }

        Session::flash('message', 'Success|Data Inserted Successfuly');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Download $download)
    {
        //
    }
}
