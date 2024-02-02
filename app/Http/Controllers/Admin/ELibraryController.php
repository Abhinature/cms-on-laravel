<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ELibrary;
use Illuminate\Http\Request;
use AUTH;
use Session;

class ELibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (AUTH::user()->user_type == '3') {
            $mandatory = ELibrary::where('unit_id', AUTH::user()->unit_id)->where('status', '!=', '10')->get();
            $product_count = $mandatory->count();
        } elseif (AUTH::user()->user_type == 9) {
            $mandatory = ELibrary::where('unit_id', AUTH::user()->unit_id)->where('status', '!=', '0')->where('status', '!=', '10')->get();
            $product_count = $mandatory->count();
        }

        return view('elibrary.list', ['mandatory' => $mandatory, 'product_count' => $product_count]);
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

        $new = new ELibrary;
        $new->unit_id = AUTH::user()->unit_id;
        $new->en_title = $request->en_title;
        $new->hi_title = $request->hi_title;
        $new->author = $request->author;
        $new->created_by = AUTH::user()->id;
        $new->document = $web_logo;
        $new->save();
        Session::flash('message', 'success|Data Inserted Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ELibrary $eLibrary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataaa = ELibrary::where('id', $id)->first();
        if (!empty($dataaa)) {
            $del = '';
            if($dataaa->live_table_id !=0){
                $del ='<div class="form-group">
                <label>Request For</label><br>
                &nbsp;&nbsp;&nbsp; 
                <input type="radio" class="request_for_delete" rel_id="' . $dataaa->id . '" rel_name="download" name="request_for" value="0" />Delete&nbsp;&nbsp;&nbsp;
                <input type="radio" class="request_for_delete" name="request_for" rel_id="' . $dataaa->id . '" rel_name="modify"  value="1" />Modify
              </div>';
            }
            $data =  '<div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Update ELibrary </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   <br>  
                           
               </div>
               '.$del.' 
               <form method="POST" enctype="multipart/form-data" action="' . route('update-library') . '">
               
                <div class="modal-body ">
               
                  <div class="hide_on_delete_check">
                
            
                   <div class="form-group">
                     <label>Title (English)</label>
                     
                     <input type="hidden" name="_token" value="' . csrf_token() . '" />
                     <input type="hidden" name="library_hid" value="' . $dataaa->id . '"/>
                     <input type="text" value="' . $dataaa->en_title. '" class="form-control" name="en_title" />
                   </div>
                   <div class="form-group">
                   <label>Title (Hindi)</label>
                   <input type="text" value="' . $dataaa->hi_title . '" class="form-control" name="hi_title" />
                 </div>     
                 <div class="form-group">
                   <label>Author</label>
                   <input type="text" value="' . $dataaa->author . '" class="form-control" name="author" />
                 </div>
                 <div class="form-group">
                   <label>Document</label>
                   <input type="file" name="disclosure" class="form-control"/>
                   <input type="hidden" value="' . $dataaa->document . '" class="form-control" name="update_attachment" />
                 </div>              
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary">Save</button>
                   
                 </div>
                 </div>
                 </form>
             </div>
           </div>';
            return $data;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ELibrary $eLibrary)
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
        $live_data = ELibrary::where('id', $request->library_hid)->first();
        if ($live_data->live_table_id == 0) {
            ELibrary::where('id', $request->download_hid)->update([
                'en_title' => $request->en_title,
                'hi_title' => $request->hi_title,
                'author' => $request->author,
                'created_by' => AUTH::user()->id,
                'document' => $web_logo,
                "status" => 0,

            ]);
        } else {
            $new = new ELibrary;
            $new->unit_id = AUTH::user()->unit_id;
            $new->hi_title = $request->hi_title;
            $new->en_title = $request->en_title;
            $new->author = $request->author;
            $new->created_by = AUTH::user()->id;
            $new->document = $web_logo;
            $new->save();
        }

        Session::flash('message', 'Success|Data Inserted Successfuly');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ELibrary $eLibrary)
    {
        //
    }
}
