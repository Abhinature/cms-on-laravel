<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\QuickLink;
use Illuminate\Http\Request;
use AUTH;
use Session;

class QuickLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
    public function index()
    {
        if (AUTH::user()->user_type == '3') {
            $mandatory = QuickLink::all();
            $product_count = $mandatory->count();
        } elseif (AUTH::user()->user_type == 9) {
            $mandatory = QuickLink::where('status', '!=', '0')->get();
            $product_count = $mandatory->count();
        }

        return view('quicklinks.list-quicklink', ['mandatory' => $mandatory, 'product_count' => $product_count]);
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
                return redirect()->back();
            }
        } else {
            $web_logo = '';
        }
        $new  = new QuickLink;
        $new->logo_image = $web_logo;
        $new->url = $request->url;        
        $new->created_by = AUTH::user()->id;
        $new->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(QuickLink $quickLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataaa = QuickLink::where('id', $id)->first();
        if (!empty($dataaa)) {
            $data =  '<div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Download </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" enctype="multipart/form-data" action="' . route('update-quicklinks') . '">
              
               <div class="modal-body">     
                    <input type="hidden" name="_token" value="' . csrf_token() . '" />
                    <input type="hidden" name="quick_hid" value="' . $dataaa->id . '"/>
                  <div class="form-group">
                  <label>URL</label>
                  <input type="text" value="' . $dataaa->url . '" class="form-control" name="url" />
                </div>     
                
                <div class="form-group">
                  <label>Logo Image</label>
                  <input type="file" name="disclosure" class="form-control"/>
                  <input type="hidden" value="' . $dataaa->logo_image . '" class="form-control" name="update_attachment" />
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
    public function update(Request $request, QuickLink $quickLink)
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
        $live_data = QuickLink::where('id', $request->quick_hid)->first();
        if ($live_data->live_table_id == 0) {
            QuickLink::where('id', $request->quick_hid)->update([
                'url' => $request->url,
                'logo_image' => $web_logo

            ]);
        } else {
            $new = new QuickLink;
            $new->logo_image = $web_logo;
            $new->url = $request->url;
            $new->save();
        }

        Session::flash('message', 'Success|Data Inserted Successfuly');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuickLink $quickLink)
    {
        //
    }
}
