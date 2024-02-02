<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\AdminReport;
use App\Models\FinanceReport;
use App\Models\FinancialYear;
use App\Models\SupplyReport;
use App\Models\CapexReport;
use App\Models\Unit;
use Illuminate\Http\Request;
use AUTH;
use Illuminate\Support\Facades\DB;
use Session;

class AdminReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $financeReport = FinanceReport::select()->get();
        // $financialYear = FinancialYear::orderby('id', 'DESC')->get();
        // $fincount = $financeReport->count();
       
        if(Auth::user()->unit_id == 0){
            $supplyreport = SupplyReport::select()->where('status','1')->get();
            $capexreport = CapexReport::select()->where('status','1')->get();
            $financeReport = FinanceReport::select()->get();
            $financialYear = FinancialYear::orderby('id', 'DESC')->get();
            $fincount = $financeReport->count();
            $adminReport = AdminReport::select()->get();
            $count = $adminReport->count();
            $units = Unit::where('status',1)->get();
            return view('admin-report.list')->with(['capexreport'=>$capexreport,'supplyreport'=>$supplyreport,'AdminReport'=> $adminReport,'years' => $financialYear,'fincount'=>$fincount, 'financeReport' => $financeReport,'count'=>$count,'Units'=>$units]);
        }else{
            $supplyreport = SupplyReport::select()->where('created_by_unit',AUTH::user()->unit_id)->where('status','1')->get();
            $capexreport = CapexReport::select()->where('created_by_unit',AUTH::user()->unit_id)->where('status','1')->get();
            $financeReport = FinanceReport::select()->where('unit_id',AUTH::user()->unit_id)->get();
            $financialYear = FinancialYear::orderby('id', 'DESC')->get();
            $fincount = $financeReport->count();
            $adminReport = AdminReport::select()->where('unit_id',AUTH::user()->unit_id)->get();
            $count = $adminReport->count();
            $units = Unit::where('status',1)->get();
            return view('admin-report.list')->with(['capexreport'=>$capexreport,'supplyreport'=>$supplyreport,'AdminReport'=> $adminReport,'years' => $financialYear,'fincount'=>$fincount, 'financeReport' => $financeReport,'count'=>$count,'Units'=>$units]);
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
        $check = AdminReport::where('date_from',$request->date_from)
                            ->where('date_to',$request->date_to)
                            ->where('report_type',$request->report_type)
                            ->where('unit_id',$request->unit_id)->first();
        if(empty($check)){
            if ($request->hasFile('report_file')) {
                $imageName = time() . '.' . $request->report_file->extension();
                $imgname =  $request->report_file->getClientOriginalName();
                $dotcount = substr_count($imgname, ".");
                if ($dotcount == '1') {
                    $request->report_file->move('upload/websitelogo', $imageName);
                    $web_logo = 'upload/websitelogo/' . $imageName;
                } else {
                    Session::flash('message', 'danger|File Name Must Contain Only One "."');
                    return redirect()->back();
                }
            } else {
                $web_logo = '';
            }
    
            $new = new AdminReport;
            $new->unit_id = $request->unit_id;
            $new->date_from = $request->date_from;
            $new->date_to = $request->date_to;
            $new->report_type = $request->report_type;
            $new->report_file = $web_logo;
            $new->created_by = AUTH::user()->id;       
            $new->save();
            Session::flash('message', 'success|Data Inserted Successfully');
        }else{
            Session::flash('message', 'success|Record Is Already Exists!!');
        }
       
       
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminReport $adminReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminReport $adminReport, $id)
    {

        $dataaa = AdminReport::where('id', $id)->first();
        $units = Unit::where('status', 1)->get();
        if (!empty($dataaa)) {
            $del = '';

            $data =  '<div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Update Report </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   <br>  
                           
               </div>
               <form method="POST" enctype="multipart/form-data" action="' . route('update-admin') . '">
               
                <div class="modal-body editmodalbody">              
            
                   <div class="form-group">
                     <label>Unit</label>
                     
                     <input type="hidden" name="_token" value="' . csrf_token() . '" />
                     <input type="hidden" name="admin_hid" value="' . $dataaa->id . '"/>
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
                   <label>Date From</label>
                   <input type="date" required value="'.$dataaa->date_from.'"  class="form-control" name="date_from" />
                 </div>
                 <div class="form-group">
                   <label>Date To</label>
                   <input type="date" required value="'.$dataaa->date_to.'" class="form-control" name="date_to" />
                 </div>    
                 <div class="form-group">
                   <label>Report Type</label>           
                   <select name="report_type" required class="form-control">
                   <option value="">--Select Report Type--</option>';
                     if($dataaa->report_type == "Arbitration Cases"){ $data .='<option selected value="Arbitration Cases">Arbitration Cases</option>';}else{ $data .='<option value="Arbitration Cases">Arbitration Cases</option>';}
                     if($dataaa->report_type == "Pension Claimed"){ $data .='<option selected value="Pension Claimed">Pension Claimed</option>';}else{ $data .='<option value="Pension Claimed">Pension Claimed</option>';}
                     if($dataaa->report_type == "No Of Vacancies"){ $data .='<option selected value="No Of Vacancies">No Of Vacancies</option>';}else{ $data .='<option value="No Of Vacancies">No Of Vacancies</option>';}
                     if($dataaa->report_type == "Admin-10"){ $data .='<option selected value="Admin-10">Admin-10</option>';}else{ $data .='<option value="Admin-10">Admin-10</option>';}
                     if($dataaa->report_type == "Admin-11"){ $data .='<option selected value="Admin-11">Admin-11</option>';}else{ $data .='<option value="Admin-11">Admin-11</option>';}
                     if($dataaa->report_type == "Admin-22"){ $data .='<option selected value="Admin-22">Admin-22</option>';}else{ $data .='<option value="Admin-22">Admin-22</option>';}
                     if($dataaa->report_type == "Land Report"){ $data .='<option selected value="Land Report">Land Report</option>';}else{ $data .='<option value="Land Report">Land Report</option>';}
                     if($dataaa->report_type == "CPGRAMS"){  $data .='<option selected value="CPGRAMS">CPGRAMS</option>';}else{ $data .='<option value="CPGRAMS">CPGRAMS</option>';}
                     if($dataaa->report_type == "Vacant-Quarter"){  $data .='<option selected value="Vacant-Quarter">Vacant-Quarter</option>';}else{ $data .='<option value="Vacant-Quarter">Vacant-Quarter</option>';}
                     if($dataaa->report_type == "Board-Of-Enquiry"){ $data .='<option selected value="Board-Of-Enquiry">Board-Of-Enquiry</option>';}else{ $data .='<option value="Board-Of-Enquiry">Board-Of-Enquiry</option>';}
                     if($dataaa->report_type == "Court-Of-Enquiry"){ $data .='<option selected value="Court-Of-Enquiry">Court-Of-Enquiry</option>';}else{ $data .='<option value="Court-Of-Enquiry">Court-Of-Enquiry</option>';}
                     if($dataaa->report_type == "Other Report"){  $data .='<option selected value="Other Report">Other Report</option>'; }else{  $data .='<option value="Other Report">Other Report</option>'; }
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
    public function update(Request $request, AdminReport $adminReport)
    {
        {
            $check = AdminReport::where('date_from',$request->date_from)
                                ->where('date_to',$request->date_to)
                                ->where('report_type',$request->report_type)
                                ->where('unit_id',$request->unit_id)
                                ->where('id','!=',$request->admin_hid)->first();
            if(empty($check)){
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
        
                AdminReport::where('id',$request->admin_hid)->update([
                    'unit_id' => $request->unit_id,
                    'date_from' => $request->date_from,
                    'date_to' => $request->date_to,
                    'report_type' => $request->report_type,
                    'report_file' => $web_logo,
                    'created_by' => AUTH::user()->id
                ]);
                
                Session::flash('message', 'success|Data Inserted Successfully');
            }else{
                Session::flash('message', 'success|Record Is Already Exists!!');
            }
           
           
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminReport $adminReport)
    {
        //
    }

    public function viewreport(){
        $unit = Unit::where('status',1)->get();
        $year = FinancialYear::where('status',1)->get();
        return view('admin-report.view-report',['action'=>'search','count'=>'0','unit'=>$unit,'financial_year'=>$year]);
    }

    public function searchadminreport(Request $request){
        // dd($request->all());
        $unit = Unit::where('status',1)->get();
        $year = FinancialYear::where('status',1)->get();
        DB::enableQueryLog();
        $adminReport = AdminReport::select()->where('unit_id',$request->unit_id)->where('date_from','>=',$request->date_from)->where('date_to','<=',$request->date_to)->get();
        $count = $adminReport->count();       
        // print_r($adminReport);
        // dd(db::getQuerylog());
        return view('admin-report.view-report',['action'=>'View','reportdata'=>$adminReport,'count'=>$count,'unit'=>$unit,'financial_year'=>$year]);

    }
}
