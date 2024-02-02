<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\FinanceReport;
use Illuminate\Http\Request;
use Auth;
use App\Models\Unit;
use App\Models\FinancialYear;
use Session;



class FinanceReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->unit_id == 0) {
            $financeReport = FinanceReport::select()->get();
            $financialYear = FinancialYear::orderby('id', 'DESC')->get();
            $count = $financeReport->count();
            $units = Unit::where('status', 1)->get();
            return view('finance.list')->with(['years' => $financialYear, 'financeReport' => $financeReport, 'count' => $count, 'Units' => $units]);
        }
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
        $check = FinanceReport::where('financial_year', $request->financial_year)->where('unit_id', $request->unit_id)->where('budget_type', $request->budget_type)->first();
        if (empty($check)) {
            if ($request->hasFile('budget_file')) {
                $imageName = time() . '.' . $request->budget_file->extension();
                $imgname =  $request->budget_file->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->budget_file->move('upload/websitelogo', $imageName);
                    $web_logo = 'upload/websitelogo/' . $imageName;
                } else {
                    Session::flash('message', 'danger|File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            } else {
                $web_logo = '';
            }

            $new = new FinanceReport();
            $new->unit_id = $request->unit_id;
            $new->financial_year = $request->financial_year;
            $new->budget_type = $request->budget_type;
            $new->budget_file = $web_logo;
            $new->remarks = $request->remarks;
            $new->created_by = AUTH::user()->id;
            $new->save();
            Session::flash('message', 'success|Data Inserted Successfully');
        } else {
            Session::flash('message', 'success|Record Already Exists');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceReport $financeReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinanceReport $financeReport, $id)
    {

        $dataaa = FinanceReport::where('id', $id)->first();
        $years = FinancialYear::orderby('id', 'DESC')->get();
        $units = Unit::where('status', 1)->get();
        if (!empty($dataaa)) {
            $del = '';

            $data =  '<div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Update Report </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   <br>  
                           
               </div>
               <form method="POST" enctype="multipart/form-data" action="' . route('update-finance') . '">
               
                <div class="modal-body editmodalbody">              
            
                   <div class="form-group">
                     <label>Unit</label>
                     
                     <input type="hidden" name="_token" value="' . csrf_token() . '" />
                     <input type="hidden" name="finance_hid" value="' . $dataaa->id . '"/>
                     <select class="form-control" required name="unit_id">
                   <option value="">----select unit----</option>';
            if ($dataaa->unit_id == '0') {
                $data .= '<option selected value="0">Yantra India Limited (यंत्र इंडिया लिमिटेड)</option>';
            }
            foreach ($units as $u) {
                if ($u->id == $dataaa->unit_id) {
                    $data .=  '<option selected value="' . $u->id . '">' . $u->en_unit_name . ' (' . $u->hi_unit_name . ')</option>';
                } else {
                    $data .=   '<option value="' . $u->id . '">' . $u->en_unit_name . '(' . $u->hi_unit_name . ')</option>';
                }
            }
            $data .=  '</select>
                   </div>
                   <div class="form-group">
                   <label>Financial Year</label>
                   <select name="financial_year" required class="form-control">
            <option value="">--select financial Year--</option>';
            foreach ($years as $y)
                if ($y->id == $dataaa->financial_year) {
                    $data .= '<option selected value="' . $y->id . '">' . $y->years . '</option>';
                } else {
                    $data .= '<option  value="' . $y->id . '">' . $y->years . '</option>';
                }
            $data .= '</select>
                 </div>     
                 <div class="form-group">
                   <label>Budget</label>           
                   <select name="budget_type" required class="form-control">
                   <option value="">--Select Budget Type--</option>';
            if ($dataaa->budget_type == "BE") {
                $data .= '<option selected value="BE">BE</option>';
            } else {
                $data .= '<option value="BE">BE</option>';
            }
            if ($dataaa->budget_type == "RE") {
                $data .= '<option selected value="RE">RE</option>';
            } else {
                $data .= '<option value="RE">RE</option>';
            }
            if ($dataaa->budget_type == "MA") {
                $data .= '<option selected value="MA">MA</option>';
            } else {
                $data .= '<option value="MA">MA</option>';
            }
            $data .= '</select>
                 </div>   
              
                 <div class="form-group">
                   <label>Document</label>
                   <input type="file" name="disclosure" class="form-control"/>
                   <input type="hidden" value="' . $dataaa->document . '" class="form-control" name="update_attachment" />
                 </div>     
                 <div class="form-group">
            <label>Remarks</label>
            <textarea placeholder="Enter Remarks" class="form-control" name="remarks">' . $dataaa->remarks . '</textarea>
          </div>         
                 </div>
                 <div class="modal-footer">
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
    public function update(Request $request, FinanceReport $financeReport)
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

        $check = FinanceReport::where('id', '!=', $request->finance_hid)->where('financial_year', $request->financial_year)->where('unit_id', $request->unit_id)->where('budget_type', $request->budget_type)->first();
        if (!empty($check)) {
            Session::flash('message', 'success|Record Already Exists');
        } else {
            FinanceReport::where('id', $request->finance_hid)->update([
                'unit_id' => $request->unit_id,
                'financial_year' => $request->financial_year,
                'budget_type' => $request->budget_type,
                'budget_file' => $web_logo,
                'remarks' => $request->remarks,
                'created_by' => AUTH::user()->id

            ]);
        }
        Session::flash('message', 'success|Data Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinanceReport $financeReport)
    {
        //
    }

    public function viewbudgetreport(){
        
        
    }




}
