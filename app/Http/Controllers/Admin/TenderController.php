<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tender;
use Illuminate\Http\Request;
use Auth;
use Session;
class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (AUTH::user()->user_type == '3') {
            $mandatory = Tender::where('unit_id', AUTH::user()->unit_id)->get();
            $product_count = $mandatory->count();
        } elseif (AUTH::user()->user_type == 9) {
            $mandatory = Tender::where('unit_id', AUTH::user()->unit_id)->where('status', '!=', '0')->get();
            $product_count = $mandatory->count();
        }

        return view('tender.list', ['tender' => $mandatory, 'tender_count' => $product_count]);
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
        if ($request->hasFile('report')) {
            $imageName = time() . '.' . $request->report->extension();
            $imgname =  $request->report->getClientOriginalName();
            $dotcount = substr_count($imgname, ".");
            if ($dotcount == '1') {
                $request->report->move('upload/tender', $imageName);
                $web_logo = 'upload/tender/' . $imageName;
            } else {
                Session::flash('message', 'danger|File Name Must Contain Only One "."');
                return redirect()->back();
            }
        } else {
            $web_logo = '';
        }
        Tender::Create([
            'en_title' => $request->en_title,
            'hi_title' => $request->hi_title,
            'file' => $web_logo,
            'created_by' => Auth::user()->id,
            'unit_id' => Auth::user()->unit_id
        ]);
        Session::flash('message', 'Success|Data Inserted Successfully!!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tender $tender)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dataaa = Tender::where('id', $id)->first();

        if (!empty($dataaa)) {
            $html = view('tender.edit-tender')->with(['dataaa' => $dataaa])->render();
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
        $chck = Tender::where('en_title', $request->en_title)->where('hi_title', $request->hi_title)->where('id', '!=', $request->tender_hid)->first();

        if (!empty($chck)) {
            return redirect()->back()->with(['msg' => 'Tender Already Exists']);
        } 
        
        else {

            $image = '';
            if ($request->hasFile('tender_report')) {
                $imageName = time() . 'thumb.' . $request->tender_report->extension();
                $imgname =  $request->tender_report->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->tender_report->move('upload/media', $imageName);
                    $image = 'upload/media/' . $imageName;
                } else {
                    Session::flash('message', 'danger|File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            } else {
                $image = $request->update_attachment;
            }

            


           
            $live_data = Tender::where('id',$request->tender_hid)->first();
         
            if ($live_data->live_table_id == '0' || ($live_data->status != '1')) {
                
                Tender::find($request->tender_hid)->update([
                    'en_title' => $request->input('en_title'),
                    'hi_title' => $request->input('hi_title'),
                    'file' =>  $request->tender_report
                   
                ]);
            } else {
                $mm = new  Tender;
                $mm->en_title = $request->en_title;
                $mm->hi_title = $request->hi_title;
                $mm->file = $request->tender_report;
                if($request->request_for == '1'){
                $mm->type = '1';
                }
                $mm->live_table_id = $live_data->live_table_id;
                $mm->created_by = Auth::user()->id;
                $mm->save();
            }

            return redirect()->back()->with(['msg' => 'Tender updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tender $tender)
    {
        //
    }
}
