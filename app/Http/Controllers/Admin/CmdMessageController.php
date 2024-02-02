<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CmdMessage;
use Illuminate\Http\Request;
use App\DataTables\CmdDataTable;
use Auth;
use Illuminate\Support\Facades\Crypt;
use Session;

class CmdMessageController extends Controller
{
    public function index(CmdDataTable $datatable){
        if(Auth::user()->user_type =='3'){
            $data = CmdMessage::all();
        }else{
            $data = CmdMessage::where('status','!=','0')->get();
            // print_r($data);
        }
        return view('cmd-message.list',['data'=>$data]);
        // return $datatable->render('cmd-message.list');
    }


    public function savecmdmessage(Request $request){
        // echo 'hello';
        $image = '';
        if ($request->hasFile('image')) {
            $imageName = time() . 'thumb.' . $request->image->extension();
            $imgname =  $request->image->getClientOriginalName();
            $dotcount = substr_count($imgname, ".");
            if ($dotcount == '1') {
                $request->image->move('upload/Who', $imageName);
                $image = 'upload/Who/' . $imageName;
            } else {                
                Session::flash('message', 'danger|File Name Must Contain Only One "."');
                return redirect()->back();
            }
        } 
            $sc = new CmdMessage;
            $sc->image = $image;
            $sc->en_description = $request->en_description;
            $sc->hi_description = $request->hi_description;
            $sc->created_by = Auth::user()->id;
            $sc->save();
            Session::flash('message', 'success|Data Inserted Successfully');
            return redirect()->route('cmd-message');        
    }

    public function editcmdmessage(Request $request,$id){
        // dd($id);
        $id = Crypt::decrypt($id);
        $content = CmdMessage::where('id',$id)->first();
        return view('cmd-message.edit',['content'=>$content]);
    }

    public function updatecmdmessage(Request $request){
        $live_table_id = CmdMessage::where('id',$request->hid)->first();
        $image = '';
        if ($request->hasFile('image')) {
            $imageName = time() . 'thumb.' . $request->image->extension();
            $imgname =  $request->image->getClientOriginalName();
            $dotcount = substr_count($imgname, ".");
            if ($dotcount == '1') {
                $request->image->move('upload/Who', $imageName);
                $image = 'upload/Who/' . $imageName;
            } else {                
                Session::flash('message', 'danger|File Name Must Contain Only One "."');
                return redirect()->back();
            }
        }else{
            $image = $request->update_image;
        }
        if(!empty($live_table_id)){
            if($live_table_id->live_table_id =='0' || ($live_table_id->status != '1')){
                CmdMessage::find($request->hid)->update([
                    'image' => $image,
                    'en_description' => $request->en_description,
                    'hi_description' => $request->hi_description
                ]);
            }else{
                $sc = new CmdMessage;
                $sc->image = $image;
                $sc->en_description = $request->en_description;
                $sc->hi_description = $request->hi_description;
                $sc->type = '1';
                $sc->live_table_id = $live_table_id->live_table_id;
                $sc->created_by = Auth::user()->id;
                $sc->save();
            }    
            Session::flash('message','success|Data updated Successfully');
            return redirect()->route('unit-website');      
        }else{
            Session::flash('message', 'danger|No data exists"."');
            return redirect()->back();
        }
    }

}
