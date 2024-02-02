<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use AUTH;
use Session;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
            if (AUTH::user()->user_type == '3') {
                $mandatory = Career::where('status', '!=', '10')->where('unit_id', AUTH::user()->unit_id)->get();
                $product_count = $mandatory->count();
            } elseif (AUTH::user()->user_type == 9 && AUTH::user()->unit_id =='0')  {
                $mandatory = Career::where('status', '!=', '0')->where('status', '!=', '10')->get();
                $product_count = $mandatory->count();
            }elseif(AUTH::user()->user_type == 9 && AUTH::user()->unit_id !='0'){
                $mandatory = Career::where('status', '!=', '0')->where('status', '!=', '10')->get();
                $product_count = $mandatory->count();
            }
    
            return view('career.list', ['mandatory'=>$mandatory,'product_count'=>$product_count]);
        
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

        $new = new Career;
        $new->unit_id = AUTH::user()->unit_id;
        $new->en_subject = $request->en_subject;
        $new->hi_subject = $request->hi_subject;
        $new->created_by = AUTH::user()->id;
        $new->document = $web_logo;
        $new->valid_till = $request->valid_till; 
        $new->valid_from = $request->valid_from;
        $new->save();
        Session::flash('message', 'success|Data Inserted Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Career $career)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataaa = Career::where('id', $id)->first();
        if (!empty($dataaa)) {
            $data =  '<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Career </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" enctype="multipart/form-data" action="' . route('update-career') . '">
              
               <div class="modal-body">     
                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                    <input type="hidden" name="career_hid" value="' . $dataaa->id . '"/>
                  <div class="form-group">
                  <label>Subject (English)</label>
                  <input type="text" value="' . $dataaa->en_subject . '" class="form-control" name="en_subject" />
                </div>    
                <div class="form-group">
                <label>Subject (Hindi)</label>
                <input type="text" value="' . $dataaa->hi_subject . '" class="form-control" name="hi_subject" />
              </div>
              <div class="form-group">
              <label>Valid From</label>
              <input type="text" value="' . $dataaa->valid_from . '" class="form-control" name="valid_from" />
            </div>
            <div class="form-group">
            <label>Valid Till</label>
            <input type="text" value="' . $dataaa->valid_till . '" class="form-control" name="valid_till" />
          </div> 
                
                <div class="form-group">
                  <label>Document</label>
                  <input type="file" name="disclosure" class="form-control"/>
                  <input type="hidden" value="' . $dataaa->document . '" class="form-control" name="update_attachment" />
                </div>              
                </div>
                <div class="modal-footer mt-2">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
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
    public function update(Request $request){
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
        $live_data = Career::where('id', $request->career_hid)->first();
        if ($live_data->live_table_id == 0) {
            Career::where('id', $request->career_hid)->update([
                "en_subject" => $request->en_subject,
                "hi_subject" => $request->hi_subject,
                "valid_from" => $request->valid_from,
                "valid_till" => $request->valid_till,
                "created_by" => AUTH::user()->id,
                "document" => $web_logo

            ]);
        } else {
            $new = new Career;
            $new->unit_id = AUTH::user()->unit_id;
            $new->en_subject = $request->en_subject;
            $new->hi_subject = $request->hi_subject;
            $new->valid_from = $request->valid_from;
            $new->valid_till = $request->valid_till;
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
    public function destroy(Career $career)
    {
        //
    }
}
