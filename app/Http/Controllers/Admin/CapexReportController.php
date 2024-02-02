<?php

namespace App\Http\Controllers\Admin;

use App\Models\CapexReport;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\CapexExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use Session;

class CapexReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $new = new CapexReport;
        $new->factory = $request->factory;
        $new->head_of_expenditure = $request->head_of_expenditure;
        $new->description_of_pm = $request->description_of_pm;
        $new->cash_flow_month = $request->cash_flow_month;
        $new->cash_flow_year = $request->cash_flow_year;
        $new->cash_flow_value = $request->cash_flow_value;
        $new->created_by_unit = Auth::user()->unit_id;
        $new->created_by_user = Auth::user()->id;
        if ($new->save()) {
            Session::flash('message', 'success|Data Inserted Successfully');
            return redirect()->back();
        } else {
            Session::flash('message', 'Danger|Data Error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CapexReport $capexReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CapexReport $capexReport, $del)
    {
        $dataaa = CapexReport::where('id', $del)->first();
        $units = Unit::where('status', 1)->get();
        if (!empty($dataaa)) {
            $del = '';

            $data =  '<div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Update Capex Report </h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   <br>  
                   
       </div>
       <form method="POST" enctype="multipart/form-data" action="' . route('update-capex-report') . '">
   
        <div class="modal-body editmodalbody">  
        <input type="hidden" name="_token" value="' . csrf_token() . '" />
        <input type="hidden" name="capex_hid" value="' . $dataaa->id . '"/>            
     <div class="row">
       s
         <div class="col-sm-12">
           <div class="form-group">
             <label>Factory</label>
             <select class="form-control" required name="factory">
               <option value="">----Select Factory----</option>';
            if ($dataaa->factory == '0') {
                $data .= '<option selected value="0">Yantra India Limited (यंत्र इंडिया लिमिटेड)</option>';
            } else {
                $data .=  '<option value="0">Yantra India Limited (यंत्र इंडिया लिमिटेड)</option>';
            }
            foreach ($units as $u) {
                if ($u->id == $dataaa->factory) {
                    $data .= '<option selected value="' . $u->id . '">' . $u->en_unit_name . ' (' . $u->hi_unit_name . ')</option>';
                } else {
                    $data .= '<option value="' . $u->id . '">' . $u->en_unit_name . ' (' . $u->hi_unit_name . ')</option>';
                }
            }

            $data .= '</select>
           </div>
         </div>
         <div class="col-sm-12">
             <div class="form-group">
             <label>Head of Expenditure</label>
             <input type="text" name="head_of_expenditure" value="' . $dataaa->head_of_expenditure . '" class="form-control"/>
             </div>
         </div>
         <div class="col-sm-12">
             <div class="form-group">
             <label>Description of P & M</label>
             <input type="text" name="description_of_pm" value="' . $dataaa->description_of_pm . '" class="form-control"/>
             </div>
         </div>
         <div class="col-sm-12">
             <div class="form-group">
             <label>Cash Flow Month</label>
             <input type="text" name="cash_flow_month" value="' . $dataaa->cash_flow_month . '" class="form-control"/>
             </div>
         </div>
         <div class="col-sm-12">
             <div class="form-group">
             <label>Cash Flow Year</label>
             <input type="text" name="cash_flow_year" value="' . $dataaa->cash_flow_year . '" class="form-control"/>
             </div>
         </div>
         <div class="col-sm-12">
             <div class="form-group">
             <label>Cash Flow Value</label>
             <input type="text" name="cash_flow_value" value="' . $dataaa->cash_flow_value . '" class="form-control"/>
             </div>
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
    public function update(Request $request, CapexReport $capexReport)
    {
        CapexReport::find($request->capex_hid)->update([
            'factory' =>  $request->factory,
            'head_of_expenditure' => $request->head_of_expenditure,
            'description_of_pm' => $request->description_of_pm,
            'cash_flow_month' => $request->cash_flow_month,
            'cash_flow_year' => $request->cash_flow_year,
            'cash_flow_value' => $request->cash_flow_value,
            'created_by_unit' => Auth::user()->unit_id,
            'created_by_user' => Auth::user()->id

        ]);

        Session::flash('message', 'success|Data Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CapexReport $capexReport)
    {
        //
    }
    public function export()
    {
        return Excel::download(new CapexExport, 'capex.xlsx');
    }
}
