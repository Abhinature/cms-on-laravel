<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupplyReport;
use App\Models\Unit;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Exports\SupplyExport;
use Maatwebsite\Excel\Facades\Excel;

class SupplyReportController extends Controller
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
        $new = new SupplyReport;
        $new->factory = $request->unit_id;
        $new->demand_type = $request->demand_type;
        $new->nomenclature = $request->nomenclature_of_p_m;
        $new->demand_no = $request->demand_no;
        $new->end_store = $request->end_store;
        $new->so_no_loi = $request->so_no_loi;
        $new->so_date_loi_date = $request->so_date_loi_date;
        $new->quantity = $request->quantity;
        $new->name_of_supplier = $request->name_of_supplier;
        $new->delivery_period_as_per_so = $request->delivery_period_as_per_so;
        $new->commisioning_date = $request->commisioning_date;
        $new->fe_cost = $request->fe_cost;
        $new->re_cost = $request->re_cost;
        $new->total = $request->total;
        $new->date_of_receipt_of_machine = $request->date_of_receipt_of_machine;
        $new->date_of_commissioning = $request->date_of_commissioning;
        $new->voucher_no_date = $request->voucher_no_date;
        $new->actual_cash_flow = $request->actual_cash_flow;
        $new->balance_os = $request->balance_os;
        $new->planned_cash = $request->planned_cash;
        $new->actual_cash_flow_current = $request->actual_cash_flow_current;
        $new->tender = $request->tender;
        $new->rst = $request->rst;
        $new->tod = $request->tod;
        $new->tec = $request->tec;
        $new->tpc = $request->tpc;
        $new->area_of_utilization = $request->area_of_utilization;
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
    public function show(SupplyReport $supplyReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplyReport $supplyReport, $del)
    {
        $dataaa = SupplyReport::where('id', $del)->first();
        $units = Unit::where('status', 1)->get();
        if (!empty($dataaa)) {
            $del = '';

            $data =  '<div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Update Supply Report </h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   <br>  
                       
           </div>
           <form method="POST" enctype="multipart/form-data" action="' . route('update-supply-report') . '">
       
            <div class="modal-body editmodalbody">  
            <input type="hidden" name="_token" value="' . csrf_token() . '" />
            <input type="hidden" name="supply_hid" value="' . $dataaa->id . '"/>            
         <div class="row">
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Demand type</label>                 
                 <select name="demand_type" required class="form-control">
                   <option value="">--Select Demand Type--</option>';
            if ($dataaa->demand_type == "RR") {
                $data .= '<option selected value="RR">RR</option>';
            } else {
                $data .= '<option value="RR">RR</option>';
            }
            if ($dataaa->demand_type == "NC") {
                $data .= '<option selected value="NC">NC</option>';
            } else {
                $data .= '<option value="NC">NC</option>';
            }
            $data .= '</select>
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Factory</label>
                 <select class="form-control" required name="unit_id">
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
 
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Nomenclature of P & M</label>
                 <input type="text" value="' . $dataaa->nomenclature . '" name="nomenclature_of_p_m" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Demand No.</label>
                 <input type="text" value="' . $dataaa->demand_no . '" name="demand_no" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>End Store</label>
                 <input type="text" value="' . $dataaa->end_store . '" name="end_store" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>SO No. or LOI </label>
                 <input type="text" value="' . $dataaa->so_no_loi . '" name="so_no_loi" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label> SO Date/LOI Date </label>
                 <input type="date" value="' . $dataaa->so_date_loi_date . '" name="so_date_loi_date" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label> Quantity </label>
                 <input type="text" value="' . $dataaa->quantity . '" name="quantity" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label> Name of Supplier </label>
                 <input type="text" value="' . $dataaa->name_of_supplier . '" name="name_of_supplier" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Delivery Period as per SO/LOI </label>
                 <input type="date" value="' . $dataaa->delivery_period_as_per_so . '" name="delivery_period_as_per_so" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Commisioning Date as per SO </label>
                 <input type="date" value="' . $dataaa->commisioning_date . '" name="commisioning_date" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label> FE Cost </label>
                 <input type="text" value="' . $dataaa->fe_cost . '" name="fe_cost" value="0.00" class="form-control edit_fe_cost" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label> RE Cost </label>
                 <input type="text" value="' . $dataaa->re_cost . '" name="re_cost" value="0.00" class="form-control edit_re_cost" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label> Total </label>
                 <input type="text" value="' . $dataaa->total . '" name="total" readonly class="form-control edit_total" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Date of receipt of Machine</label>
                 <input type="date" value="' . $dataaa->date_of_receipt_of_machine . '" name="date_of_receipt_of_machine" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Date of commissioning</label>
                 <input type="date" value="' . $dataaa->date_of_commissioning . '" name="date_of_commissioning" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>m-voucher no. And date</label>
                 <input type="text" value="' . $dataaa->voucher_no_date . '" name="voucher_no_date" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label> Actual Cash flow 2022-23 </label>
                 <input type="text" value="' . $dataaa->actual_cash_flow . '" name="actual_cash_flow" value="0.00" class="form-control edit_actual_cash" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Balance O/S as on 01.04.2023</label>
                 <input type="text" value="' . $dataaa->balance_os . '" name="balance_os" class="form-control edit_balance_os" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Planned Cash flow 2023-24 </label>
                 <input type="text" value="' . $dataaa->planned_cash . '" name="planned_cash" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Actual Cash flow 2023-24 </label>
                 <input type="text" value="' . $dataaa->actual_cash_flow_current . '" name="actual_cash_flow_current" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label> Tender Mode(OTE/LTE/PAC)</label>
                 <input type="text" value="' . $dataaa->tender . '" name="tender" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label> RST (yes/No)</label>
                 <input type="text" value="' . $dataaa->rst . '" name="rst" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label> TOD </label>
                 <input type="date" value="' . $dataaa->tod . '" name="tod" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>TEC </label>
                 <input type="date" value="' . $dataaa->tec . '" name="tec" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>TPC</label>
                 <input type="date" value="' . $dataaa->tpc . '"  name="tpc" class="form-control" />
               </div>
             </div>
             <div class="col-sm-4">
               <div class="form-group">
                 <label>Area of Utilization</label>
                 <input type="text" value="' . $dataaa->area_of_utilization . '" name="area_of_utilization" class="form-control" />
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
    public function update(Request $request, SupplyReport $supplyReport)
    {
        SupplyReport::where('id', $request->supply_hid)->update([
            'factory' => $request->unit_id,
            'demand_type' => $request->demand_type,
            'nomenclature' => $request->nomenclature_of_p_m,
            'demand_no' => $request->demand_no,
            'end_store' => $request->end_store,
            'so_no_loi' => $request->so_no_loi,
            'so_date_loi_date' => $request->so_date_loi_date,
            'quantity' => $request->quantity,
            'name_of_supplier' => $request->name_of_supplier,
            'delivery_period_as_per_so' => $request->delivery_period_as_per_so,
            'commisioning_date' => $request->commisioning_date,
            'fe_cost' => $request->fe_cost,
            're_cost' => $request->re_cost,
            'total' => $request->total,
            'date_of_receipt_of_machine' => $request->date_of_receipt_of_machine,
            'date_of_commissioning' => $request->date_of_commissioning,
            'voucher_no_date' => $request->voucher_no_date,
            'actual_cash_flow' => $request->actual_cash_flow,
            'balance_os' => $request->balance_os,
            'planned_cash' => $request->planned_cash,
            'actual_cash_flow_current' => $request->actual_cash_flow_current,
            'tender' => $request->tender,
            'rst' => $request->rst,
            'tod' => $request->tod,
            'tec' => $request->tec,
            'tpc' => $request->tpc,
            'area_of_utilization' => $request->area_of_utilization,
            'created_by_unit' => Auth::user()->unit_id,
            'created_by_user' => Auth::user()->id
        ]);
        Session::flash('message', 'success|Data Updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplyReport $supplyReport,$id)
    {
        SupplyReport::where('id',$id)->update(['status','0']);
        Session::flash('message', 'Danger|Entry Deleted Error');
        return redirect()->back();
    }

    public function export() 
    {
        return Excel::download(new SupplyExport, 'users.xlsx');
    }
}
