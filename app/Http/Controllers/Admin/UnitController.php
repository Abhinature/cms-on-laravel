<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\DataTables\UnitsDataTable;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UnitsDataTable $dataTable)
    {
        return $dataTable->render('unit.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unit.add');
    }
    
    public static function getallactiveunits(){
        $check = Unit::select('units.unit_name','units.id','unit_websites.website_logo')->leftjoin('unit_websites','units.id','=','unit_websites.unit_id')->where('units.status','1')->get();
        return $check;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $check = Unit::select()->where('unit_name',$request->input('unit_name'))->first();        
        if(empty($check)){         
        $unit = new Unit; 
        $unit->en_unit_name = $request->input('en_unit_name');
        $unit->hi_unit_name = $request->input('hi_unit_name'); 
        $unit->created_by = Auth::user()->id;
        $unit->save();
        }else{
          
            return redirect()->back()->with(['error'=>'Unit Already Exists!!']);
        }
        return redirect('/units')->with(['success'=>'Unit Inserted Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit,$id)
    {
        $id = Crypt::decrypt($id);
        $data = Unit::where('id',$id)->first();
        
       return view('unit.edit')->with(['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $check = Unit::select()->where('unit_name',$request->input('unit_name'))->first();        
        if(empty($check)){         
            Unit::where('id',Crypt::decrypt($request->input('hid')))->update([
                'unit_name' => $request->input('unit_name')
            ]);
            return redirect('units')->with(['msg'=>'Data Updated Successfully !!']);
        }else{
          
            return redirect()->back()->with(['error'=>'Unit Already Exists!!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
