@extends('layouts.admin.app')

@section('content')
<style>
  /* Style the tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #0c96cb5c;
  }

  .bgcard {
    background-color: #0c96cb45;
  }

  /* Style the buttons that are used to open the tab content */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Reports</h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard /Reports</li>
        </ol>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-sm-12">
      <div style="float:right">
        <!-- <a class="btn btn-primary" href="{{route('add-page')}}">Add Page</a> -->
      </div>
    </div>
  </div>
  <div class="card mb-4">
    <div class="card-header pb-0">
      {!!displayAlert()!!}
      <h6> Reports</h6>
    </div>
    <div class="card-body">
      <div class="tab" id="myTab">
        <button class="tablinks" onclick="openCity(event, 'America')">Admin Report</button>
        <button class="tablinks" onclick="openCity(event, 'Finance')">Finance Report</button>
        <button class="tablinks" onclick="openCity(event, 'Supply')">Supply Order Placed Cases</button>
        <button class="tablinks" onclick="openCity(event, 'P&M')">P&M Demand Under Various Stages</button>
        <button class="tablinks" onclick="openCity(event, 'Capex')">CAPEX</button>
        <button class="tablinks" onclick="openCity(event, 'Integrity')">Integrity Pact</button>


      </div>

      <!-- Tab content -->

      <div id="America" class="tabcontent">
        <h3>Admin Reports</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='15')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleAdminModal" class="btn btn-primary addmorebtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead class="text-center">
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Unit
                          </th>
                          <th>
                            Date From
                          </th>
                          <th>
                            Date To
                          </th>
                          <th>
                            Report Type
                          </th>
                          <th>
                            Report
                          </th>

                          <th>
                            Remarks
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="text-center">

                        @if($count > 0)
                        @foreach($AdminReport as $wp)
                        <tr>
                          <td>{{$loop->index + 1}}</td>
                          <td>
                            @if($wp->unit_id == '0')
                            Yantra India Limited (यंत्र इंडिया लिमिटेड)
                            @else
                            @php $a = getUnitName($wp->unit_id); @endphp
                            {{$a->en_unit_name}} ({{$a->hi_unit_name}})
                            @endif
                          </td>
                          <td>
                            {{$wp->date_from ??''}}
                          </td>
                          <td>
                            {{$wp->date_to ??''}}
                          </td>
                          <td>{{$wp->report_type ??''}}</td>

                          <td>
                            @if($wp->report_file !='')
                            <a target="_blank" href="{{asset($wp->report_file)}}" class="btn btn-primary">VIEW</a>
                            @else
                            @endif
                          </td>

                          <td>{{$wp->remarks}}</td>
                          <td>
                            @if(AUTH::user()->user_type =='11')
                            {{--@if($wp->status == '1')
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editadminmodal">Another Request</button>
                            @elseif($wp->status == '2')
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editadminmodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'finance'])}}">Delete</a>
                            @elseif($wp->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wp->id),'tab'=>Crypt::encrypt('finance')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editadminmodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'finance'])}}">Delete</a>
                            @endif--}}
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editadminmodal">Edit</button>
                            @elseif(AUTH::user()->user_type=='9')
                            @if($wp->status =='1')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$wp->publish_time}}</span>
                            @elseif($wp->status =='2')
                            Submitted For Review : {{$wp->remarks ??''}}
                            @else
                            <button type="button" rel_id="{{$wp->id}}" rel="finance" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$wp->id}}" rel="finance" class="btn btn-danger review">Review</button>
                            @endif
                            @endif
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>

                    </table>
                  </div>


                </div>
              </div>

            </div>
          </div>

        </form>
      </div>

      <div id="Finance" class="tabcontent">
        <h3>Finance Report's</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='15')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleFinModal" class="btn btn-primary addmorebtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead class="text-center">
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Unit
                          </th>
                          <th>
                            Financial Year
                          </th>
                          <th>
                            Budget Type
                          </th>
                          <th>
                            Budget
                          </th>

                          <th>
                            Remarks
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @if($fincount > 0)
                        @foreach($financeReport as $wp)
                        <tr>
                          <td>{{$loop->index + 1}}</td>
                          <td>
                            @if($wp->unit_id == '0')
                            Yantra India Limited (यंत्र इंडिया लिमिटेड)
                            @else
                            @php
                            $a = getUnitName($wp->unit_id);
                            @endphp
                            {{$a->en_unit_name}} ({{$a->hi_unit_name}})
                            @endif
                          </td>
                          <td>
                            @php
                            $b = getFinancialYearById($wp->financial_year);
                            @endphp
                            {{$b->years ??''}}
                          </td>
                          <td>{{$wp->budget_type ??''}}</td>

                          <td>
                            @if($wp->budget_file !='')
                            <a target="_blank" href="{{asset($wp->budget_file)}}" class="btn btn-primary">VIEW</a>
                            @else
                            @endif
                          </td>

                          <td>{{$wp->remarks}}</td>
                          <td>
                            {{--@if(AUTH::user()->user_type =='11')
                            @if($wp->status == '1')
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Another Request</button>
                            @elseif($wp->status == '2')
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'finance'])}}">Delete</a>
                            @elseif($wp->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wp->id),'tab'=>Crypt::encrypt('finance')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'finance'])}}">Delete</a>
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($wp->status =='1')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$wp->publish_time}}</span>
                            @elseif($wp->status =='2')
                            Submitted For Review : {{$wp->remarks ??''}}
                            @else
                            <button type="button" rel_id="{{$wp->id}}" rel="finance" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$wp->id}}" rel="finance" class="btn btn-danger review">Review</button>
                            @endif
                            @endif--}}
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Edit</button>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>

                    </table>
                  </div>


                </div>
              </div>

            </div>
          </div>

        </form>
      </div>

      <div id="Supply" class="tabcontent">
        <h3>Supply Order Placed Cases</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='15')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleSupplyModal" class="btn btn-primary addmorebtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <a href="{{ url('get-report-supply')}}" class="excelbutton">Export</a>
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead class="text-center">
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Demand Type (RR/NC)
                          </th>
                          <th>
                            Factory
                          </th>
                          <th>
                            Nomenclature of P and M
                          </th>
                          <th>
                            Demand No.
                          </th>
                          <th> End store </th>
                          <th> SO No. or LOI </th>
                          <th> SO Date/LOI Date</th>
                          <th>Quantity</th>
                          <th>Name of Supplier </th>
                          <th>Delivery Period as per SO/LOI </th>
                          <th>Commisioning Date as per SO </th>
                          <th>FE Cost</th>
                          <th>RE Cost</th>
                          <th>Total</th>
                          <th>Date Of Receipt Of Machine</th>
                          <th>Date Of Commissioning</th>
                          <th>Voucher No Date</th>
                          <th>Actual Cash Flow</th>
                          <th>Balance OS</th>
                          <th>Planned Cash</th>
                          <th>Actual Cash Flow Current</th>
                          <th>Tender</th>
                          <th>RST</th>
                          <th>TOD</th>
                          <th>TEC</th>
                          <th>TPC</th>
                          <th>Area Of Utilization</th>
                          <th>Status</th>

                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="text-center">

                        @foreach($supplyreport as $sr)
                        <tr>
                          <td>{{$loop->index + 1}}</td>
                          <td>
                            {{$sr->demand_type ??''}}
                          </td>
                          <td>
                            @if($sr->factory == '0')
                            Yantra India Limited (यंत्र इंडिया लिमिटेड)
                            @else
                            @php
                            $a = getUnitName($sr->unit_id);
                            @endphp
                            {{$a->en_unit_name}} ({{$a->hi_unit_name}})
                            @endif
                          </td>

                          <td>
                            {{$sr->nomenclature ??''}}
                          </td>
                          <td>
                            {{$sr->demand_no ??''}}
                          </td>
                          <td>
                            {{$sr->end_store ??''}}
                          </td>
                          <td>
                            {{$sr->so_no_loi ??''}}
                          </td>
                          <td>
                            {{$sr->so_date_loi_date ??''}}
                          </td>
                          <td>
                            {{$sr->quantity ??''}}
                          </td>
                          <td>
                            {{$sr->name_of_supplier ??''}}
                          </td>
                          <td>
                            {{$sr->delivery_period_as_per_so ??''}}
                          </td>
                          <td>
                            {{$sr->commisioning_date ??''}}
                          </td>
                          <td>
                            {{$sr->fe_cost ??''}}
                          </td>
                          <td>
                            {{$sr->re_cost ??''}}
                          </td>
                          <td>
                            {{$sr->total ??''}}
                          </td>
                          <td>
                            {{$sr->date_of_receipt_of_machine ??''}}
                          </td>
                          <td>
                            {{$sr->date_of_commissioning ??''}}
                          </td>
                          <td>
                            {{$sr->voucher_no_date ??''}}
                          </td>
                          <td>
                            {{$sr->actual_cash_flow ??''}}
                          </td>
                          <td>
                            {{$sr->balance_os ??''}}
                          </td>
                          <td>
                            {{$sr->planned_cash ??''}}
                          </td>
                          <td>
                            {{$sr->actual_cash_flow_current ??''}}
                          </td>
                          <td>
                            {{$sr->tender ??''}}
                          </td>
                          <td>
                            {{$sr->rst ??''}}
                          </td>
                          <td>
                            {{$sr->tod ??''}}
                          </td>
                          <td>
                            {{$sr->tec ??''}}
                          </td>
                          <td>
                            {{$sr->tpc ??''}}
                          </td>
                          <td>
                            {{$sr->area_of_utilization ??''}}
                          </td>
                          <td>
                            @if($sr->status == '1')
                            Active
                            @else
                            In-active
                            @endif
                          </td>
                          <td>
                            <button rel="{{$sr->id}}" type="button" class="btn btn-primary editsupplymodal">Edit</button> | <button rel_id="{{$sr->id}}" rel_name="supply" type="button" class="btn btn-danger delsupply">Delete</button>
                          </td>
                        </tr>
                        @endforeach

                      </tbody>

                    </table>
                  </div>


                </div>
              </div>

            </div>
          </div>

        </form>
      </div>

      <div id="P&M" class="tabcontent">
        <h3>Finance Reports</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='15')
            <div class="col-md-12">
              <div style="float:right">
              <button type="button" data-bs-toggle="modal" data-bs-target="#exampleP&MModal" class="btn btn-primary addmorebtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead class="text-center">
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Unit
                          </th>
                          <th>
                            Financial Year
                          </th>
                          <th>
                            Budget Type
                          </th>
                          <th>
                            Budget
                          </th>

                          <th>
                            Remarks
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @if($fincount > 0)
                        @foreach($financeReport as $wp)
                        <tr>
                          <td>{{$loop->index + 1}}</td>
                          <td>
                            @if($wp->unit_id == '0')
                            Yantra India Limited (यंत्र इंडिया लिमिटेड)
                            @else
                            @php
                            $a = getUnitName($wp->unit_id);
                            @endphp
                            {{$a->en_unit_name}} ({{$a->hi_unit_name}})
                            @endif
                          </td>
                          <td>
                            @php
                            $b = getFinancialYearById($wp->financial_year);
                            @endphp
                            {{$b->years ??''}}
                          </td>
                          <td>{{$wp->budget_type ??''}}</td>

                          <td>
                            @if($wp->budget_file !='')
                            <a target="_blank" href="{{asset($wp->budget_file)}}" class="btn btn-primary">VIEW</a>
                            @else
                            @endif
                          </td>

                          <td>{{$wp->remarks}}</td>
                          <td>
                            {{--@if(AUTH::user()->user_type =='11')
                            @if($wp->status == '1')
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Another Request</button>
                            @elseif($wp->status == '2')
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'finance'])}}">Delete</a>
                            @elseif($wp->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wp->id),'tab'=>Crypt::encrypt('finance')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'finance'])}}">Delete</a>
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($wp->status =='1')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$wp->publish_time}}</span>
                            @elseif($wp->status =='2')
                            Submitted For Review : {{$wp->remarks ??''}}
                            @else
                            <button type="button" rel_id="{{$wp->id}}" rel="finance" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$wp->id}}" rel="finance" class="btn btn-danger review">Review</button>
                            @endif
                            @endif--}}
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Edit</button>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>

                    </table>
                  </div>


                </div>
              </div>

            </div>
          </div>

        </form>
      </div>

      <div id="Capex" class="tabcontent">
        <h3>CAPEX Reports</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='15')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleCAPEXModal" class="btn btn-primary addmorebtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div>
                <a class="btn btn-primary" href="{{route('get-report-capex')}}">Export</a>
              </div>
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead class="text-center">
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Factory
                          </th>
                          <th>
                           Head of expenditure
                          </th>
                          <th>
                            Description of P&M /Capital CW /R&D 
                          </th>
                          <th>
                            Cash Flow Month
                          </th>
                          <th>
                            Cash Flow Year
                            </th>
                          <th>
                            Cash Flow Value
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Remarks
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @if($fincount > 0)
                        @foreach($capexreport as $cp)
                        <tr>
                          <td>{{$loop->index + 1}}</td>
                          <td>
                            @if($cp->factory == '0')
                            Yantra India Limited (यंत्र इंडिया लिमिटेड)
                            @else
                            @php
                            $a = getUnitName($cp->factory);
                            @endphp
                            {{$a->en_unit_name}} ({{$a->hi_unit_name}})
                            @endif
                          </td>
                          <td>
                            {{$cp->head_of_expenditure ??''}}
                          </td>
                          <td>{{$cp->description_of_pm  ??''}}</td>
                          <td>{{$cp->cash_flow_month  ??''}}</td>
                          <td>{{$cp->cash_flow_year  ??''}}</td>
                          <td>{{$cp->cash_flow_value  ??''}}</td>
                          <td>@if($cp->status =='0')
                            Inactive
                            @else
                            Active
                            @endif
                          </td>
                          <td>{{$cp->remarks}}</td>
                          <td>                           
                            <button rel="{{$cp->id}}" type="button" class="btn btn-primary editcapexmodal">Edit</button>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>

                    </table>
                  </div>


                </div>
              </div>

            </div>
          </div>

        </form>
      </div>

      <div id="Integrity" class="tabcontent">
        <h3>Finance Report's</h3>
        <form>
          <div class="row mt-2 p-1">
            @if(AUTH::user()->user_type !='15')
            <div class="col-md-12">
              <div style="float:right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary addmorebtn">Add More</button>
              </div>
            </div>
            @endif
            <div class="col-md-12">
              <div class="card bgcard p-2">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-stripped">
                      <thead class="text-center">
                        <tr>
                          <th>
                            S.NO
                          </th>
                          <th>
                            Unit
                          </th>
                          <th>
                            Financial Year
                          </th>
                          <th>
                            Budget Type
                          </th>
                          <th>
                            Budget
                          </th>

                          <th>
                            Remarks
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @if($fincount > 0)
                        @foreach($financeReport as $wp)
                        <tr>
                          <td>{{$loop->index + 1}}</td>
                          <td>
                            @if($wp->unit_id == '0')
                            Yantra India Limited (यंत्र इंडिया लिमिटेड)
                            @else
                            @php
                            $a = getUnitName($wp->unit_id);
                            @endphp
                            {{$a->en_unit_name}} ({{$a->hi_unit_name}})
                            @endif
                          </td>
                          <td>
                            @php
                            $b = getFinancialYearById($wp->financial_year);
                            @endphp
                            {{$b->years ??''}}
                          </td>
                          <td>{{$wp->budget_type ??''}}</td>

                          <td>
                            @if($wp->budget_file !='')
                            <a target="_blank" href="{{asset($wp->budget_file)}}" class="btn btn-primary">VIEW</a>
                            @else
                            @endif
                          </td>

                          <td>{{$wp->remarks}}</td>
                          <td>
                            {{--@if(AUTH::user()->user_type =='11')
                            @if($wp->status == '1')
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Another Request</button>
                            @elseif($wp->status == '2')
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'finance'])}}">Delete</a>
                            @elseif($wp->status == '0')
                            <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($wp->id),'tab'=>Crypt::encrypt('finance')])}}" class="btn btn-success">Submit For Review</a>
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Edit</button> |
                            <a class="btn btn-danger" href="{{route('del-content',['id' => $wp->id,'rel'=>'finance'])}}">Delete</a>
                            @endif
                            @elseif(AUTH::user()->user_type=='9')
                            @if($wp->status =='1')
                            <span class="mt-2 p-2 bg-white text-dark">Approved {{$wp->publish_time}}</span>
                            @elseif($wp->status =='2')
                            Submitted For Review : {{$wp->remarks ??''}}
                            @else
                            <button type="button" rel_id="{{$wp->id}}" rel="finance" class="btn btn-success approve">Approve</button>
                            <button type="button" rel_id="{{$wp->id}}" rel="finance" class="btn btn-danger review">Review</button>
                            @endif
                            @endif--}}
                            <button rel="{{$wp->id}}" type="button" class="btn btn-primary editfinancemodal">Edit</button>
                          </td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>

                    </table>
                  </div>


                </div>
              </div>

            </div>
          </div>

        </form>
      </div>
      <!----------------------------------------->

    </div>
  </div>
</div>
</div>
<!-----------------------------------------MODALS---------------------------------------------->

<div class="modal fade" id="exampleAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MSF Admin Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-admin')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Unit</label>
            <select class="form-control" required name="unit_id">
              <option value="">----select unit----</option>
              <option value="0">Yantra India Limited (यंत्र इंडिया लिमिटेड)</option>
              @foreach($Units as $u)
              <option value="{{$u->id}}">{{$u->en_unit_name}} ({{$u->hi_unit_name}})</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Date From</label>
            <input type="date" required class="form-control" name="date_from" />
          </div>
          <div class="form-group">
            <label>Date To</label>
            <input type="date" required class="form-control" name="date_to" />
          </div>

          <div class="form-group">
            <label>Report</label>
            <select name="report_type" required class="form-control">
              <option value="">--Select Report Type--</option>
              <option value="Arbitration Cases">Arbitration Cases</option>
              <option value="Pension Claimed">Pension Claimed</option>
              <option value="No Of Vacancies">No Of Vacancies</option>
              <option value="Admin-10">Admin-10</option>
              <option value="Admin-11">Admin-11</option>
              <option value="Admin-22">Admin-22</option>
              <option value="Land Report">Land Report</option>
              <option value="CPGRAMS">CPGRAMS</option>
              <option value="Vacant-Quarter">Vacant-Quarter</option>
              <option value="Board-Of-Enquiry">Board-Of-Enquiry</option>
              <option value="Court-Of-Enquiry">Court-Of-Enquiry</option>
              <option value="Other Report">Other Report</option>
            </select>
          </div>
          <div class="form-group">
            <label>Upload File</label>
            <input type="file" required class="form-control" name="report_file" />
          </div>
          <div class="form-group">
            <label>Remarks</label>
            <textarea placeholder="Enter Remarks" class="form-control" name="remarks"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleFinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Budget Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-finance')}}">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>Unit</label>
            <select class="form-control" required name="unit_id">
              <option value="">----select unit----</option>
              <option value="0">Yantra India Limited (यंत्र इंडिया लिमिटेड)</option>
              @foreach($Units as $u)
              <option value="{{$u->id}}">{{$u->en_unit_name}} ({{$u->hi_unit_name}})</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Financial Year</label>
            <select name="financial_year" required class="form-control">
              <option value="">--select financial Year--</option>
              @foreach($years as $y)
              <option value="{{$y->id}}">{{$y->years}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Budget</label>
            <select name="budget_type" required class="form-control">
              <option value="">--Select Budget Type--</option>
              <option value="BE">BE</option>
              <option value="RE">RE</option>
              <option value="MA">MA</option>
            </select>
          </div>
          <div class="form-group">
            <label>Upload File</label>
            <input type="file" class="form-control" name="budget_file" />
          </div>
          <div class="form-group">
            <label>Remarks</label>
            <textarea placeholder="Enter Remarks" class="form-control" name="remarks"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleSupplyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width:950px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">a Placed Cases</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-supply-order')}}">
        <div class="modal-body">
          @csrf
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label>Demand type</label>
                <select name="demand_type" required class="form-control">
                  <option value="">--Select Demand Type--</option>
                  <option value="RR">RR</option>
                  <option value="NC">NC</option>
                </select>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Factory</label>
                <select class="form-control" required name="unit_id">
                  <option value="">----Select Factory----</option>
                  <option value="0">Yantra India Limited (यंत्र इंडिया लिमिटेड)</option>
                  @foreach($Units as $u)
                  <option value="{{$u->id}}">{{$u->en_unit_name}} ({{$u->hi_unit_name}})</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label>Nomenclature of P & M</label>
                <input type="text" name="nomenclature_of_p_m" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Demand No.</label>
                <input type="text" name="demand_no" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>End Store</label>
                <input type="text" name="end_store" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>SO No. or LOI </label>
                <input type="text" name="so_no_loi" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> SO Date/LOI Date </label>
                <input type="date" name="so_date_loi_date" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> Quantity </label>
                <input type="text" name="quantity" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> Name of Supplier </label>
                <input type="text" name="name_of_supplier" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Delivery Period as per SO/LOI </label>
                <input type="date" name="delivery_period_as_per_so" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Commisioning Date as per SO </label>
                <input type="date" name="commisioning_date" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> FE Cost </label>
                <input type="text" name="fe_cost" value="0.00" class="form-control fe_cost" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> RE Cost </label>
                <input type="text" name="re_cost" value="0.00" class="form-control re_cost" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> Total </label>
                <input type="text" name="total" readonly class="form-control total" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Date of receipt of Machine</label>
                <input type="date" name="date_of_receipt_of_machine" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Date of commissioning</label>
                <input type="date" name="date_of_commissioning" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>m-voucher no. And date</label>
                <input type="text" name="voucher_no_date" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> Actual Cash flow 2022-23 </label>
                <input type="text" name="actual_cash_flow" value="0.00" class="form-control actual_cash" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Balance O/S as on 01.04.2023</label>
                <input type="text" name="balance_os" class="form-control balance_os" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Planned Cash flow 2023-24 </label>
                <input type="text" name="planned_cash" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Actual Cash flow 2023-24 </label>
                <input type="text" name="actual_cash_flow_current" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> Tender Mode(OTE/LTE/PAC)</label>
                <input type="text" name="tender" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> RST (yes/No)</label>
                <input type="text" name="rst" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> TOD </label>
                <input type="date" name="tod" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>TEC </label>
                <input type="date" name="tec" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>TPC</label>
                <input type="date" name="tpc" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Area of Utilization</label>
                <input type="text" name="area_of_utilization" class="form-control" />
              </div>
            </div>

          </div>







        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleCAPEXModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width:950px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">a Placed Cases</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data" action="{{route('add-capex-order')}}">
        <div class="modal-body">
          @csrf
          <div class="row">           
            <div class="col-sm-4">
              <div class="form-group">
                <label>Factory</label>
                <select class="form-control" required name="factory">
                  <option value="">----Select Factory----</option>
                  <option value="0">Yantra India Limited (यंत्र इंडिया लिमिटेड)</option>
                  @foreach($Units as $u)
                  <option value="{{$u->id}}">{{$u->en_unit_name}} ({{$u->hi_unit_name}})</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group">
                <label>Head of Expenditure</label>
                <input type="text" name="head_of_expenditure" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Description oF PM</label>
                <input type="text" name="description_of_pm" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Cash Flow Month</label>
                <input type="text" name="cash_flow_month" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label>Cash Flow Year </label>
                <input type="text" name="cash_flow_year" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label> Cash Flow Value </label>
                <input type="date" name="cash_flow_value" class="form-control" />
              </div>
            </div>           
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-------------------------------------end Products-------------------------------------------------->

<!-------------------------------------------------Edit Modal--------------------------------------------------------------->
<div class="modal fade editmodalbyajax" id="exampleEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>
<div class="modal fade editmodalbyajaxsupply" id="exampleEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="--bs-modal-width:950px;" aria-hidden="true">

</div>


<!-- <script src="//cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script> -->
<!-- <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/6.4.3/js/tempus-dominus.js" integrity="sha512-+czcA0uweh7fUHWI4Yvixi92esLt0Y5TCZ8OitvNyMQ/9Kd1Baha34VKOztXwUgV++aUbgr9sxxniE2dwvNQ6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/6.4.3/css/tempus-dominus.min.css" integrity="sha512-wO+rVZhTyJgwKxVY279cD/TZTlW2m0IJQXzoOHfj2w//md58T3jc8ZWHb+HEm8CspcCNnaJVFPyRAGd/Y4ScfA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript">
  //


  //
  function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }


  $('body').on('click', '.approve', function() {
    var rel = $(this).attr('rel');
    var type_id = $(this).attr('rel_id')
    swal({
      title: "Are you sure,You want to approve the Content?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, archive it!",
      cancelButtonText: "No, cancel please!",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: 'Post',
          url: "{{url('sendotp')}}",
          data: {
            rel: rel,
            type_id: type_id,
            _token: "{{csrf_token()}}"
          },
          success: function(xa) {
            if (xa.success == true) {
              $('.relation').val(rel);
              $('.relid').val(type_id);
              $("#approvecontent").modal('show');
            }
          }
        });
      }
    });
  });

  $('body').on('click', '.review', function() {
    var rel = $(this).attr('rel');
    var type_id = $(this).attr('rel_id')
    swal({
      title: "Are you sure,You want to submit content for review ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, archive it!",
      cancelButtonText: "No, cancel please!",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: 'Post',
          url: "{{url('sendotp')}}",
          data: {
            rel: rel,
            type_id: type_id,
            _token: "{{csrf_token()}}"
          },
          success: function(xa) {
            if (xa.success == true) {
              $('.review_relation').val(rel);
              $('.review_relid').val(type_id);
              $("#reviewcontent").modal('show');
            }
          }
        });
      }
    });

  });

  $('body').on('click', '.saveapproval', function() {
    var publish_time = $('.publish_time').val();
    var relation = $('.relation').val();
    var relid = $('.relid').val();
    var otpval = $('.otpval').val();
    $.ajax({
      type: 'Post',
      url: "{{url('save-approval')}}",
      data: {
        publish_time: publish_time,
        relation: relation,
        relid: relid,
        otpval: otpval,
        _token: "{{csrf_token()}}"
      },
      success: function(xa) {
        // alert(xa.success);
        if (xa.success == true) {
          $("#approvecontent").modal('hide');
          swal({
            title: "Content Approved And Applied For Publish!!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
          }).then((willDelete) => {
            if (willDelete) {
              location.reload();
            }
          });

        } else if (xa.success == false) {
          $("#approvecontent").modal('hide');
          swal({
            title: xa.msg,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
          });

        }
      }
    });

  });

  $('body').on('click', '.savereview', function() {
    var publish_time = $('.remarks').val();
    var relation = $('.review_relation').val();
    var relid = $('.review_relid').val();
    var otpval = $('.reviewotpval').val();
    $.ajax({
      type: 'Post',
      url: "{{url('save-review')}}",
      data: {
        publish_time: publish_time,
        relation: relation,
        relid: relid,
        otpval: otpval,
        _token: "{{csrf_token()}}"
      },
      success: function(xa) {
        // alert(xa.success);
        if (xa.success == true) {
          $("#reviewcontent").modal('hide');
          swal({
            title: "Content Submitted For Review!!",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
          }).then((willDelete) => {
            if (willDelete) {
              location.reload();
            }
          });
        } else if (xa.success == false) {
          $("#reviewcontent").modal('hide');
          swal({
            title: xa.msg,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, archive it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
          });

        }
      }
    });

  });


  $('body').on('click', '.editadminmodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-admin')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajax').html(data);
        $('.editmodalbyajax').modal('show');
      }
    });
  });
  
  $('body').on('click', '.excelbutton', function() {
   
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('get-report-supply')}}",      
    });
  });
  $('body').on('click', '.editsupplymodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-supply-report')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajaxsupply').html(data);
        $('.editmodalbyajaxsupply').modal('show');
      }
    });
  });



  $('body').on('change', '.fe_cost,.re_cost,.actual_cash', function() {
    var fe_cost = $('.fe_cost').val();
    var re_cost = $('.re_cost').val();
    var total = eval(fe_cost) + eval(re_cost);
    var actual = $('.actual_cash').val();


    var balance = eval(total) - eval(actual);
    $('.total').val(total);
    $('.balance_os').val(balance);

  });

  $('body').on('change', '.edit_fe_cost,.edit_re_cost,.edit_actual_cash', function() {
    var fe_cost = $('.edit_fe_cost').val();
    var re_cost = $('.edit_re_cost').val();
    var total = eval(fe_cost) + eval(re_cost);
    var actual = $('.edit_actual_cash').val();


    var balance = eval(total) - eval(actual);
    $('.edit_total').val(total);
    $('.edit_balance_os').val(balance);

  });


  $('body').on('click', '.editfinancemodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-finance')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajax').html(data);
        $('.editmodalbyajax').modal('show');
        // CKEDITOR.replace('edit_manu_description');
      }
    });
  });

  $('body').on('click','.editcapexmodal',function(){
      showLoader();
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      enctype: 'multipart/form-data',
      url: "{{ url('edit-capex')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajax').html(data);
        $('.editmodalbyajax').modal('show');
      },
      complete:function(){
        hideLoader();
      }

    });
  });

  $('body').on('click', '.editmandatorymodal', function() {
    var pro_id = $(this).attr('rel');
    $.ajax({
      type: 'Get',
      url: "{{ url('edit-mandatory')}}" + '/' + pro_id,
      success: function(data) {
        $('.editmodalbyajax').html(data);
        $('.editmodalbyajax').modal('show');
      }
    });
  });

  $('body').on('click', '.delsupply', function() {
    var id = $(this).attr('rel_id');
    var rel = $(this).attr('rel_name');
    swal({
      title: "Are you sure you want to delete the content!!",
      icon: "success",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, archive it!",
      cancelButtonText: "No, cancel please!",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: 'get',
          url: "{{url('del-content')}}"+'/'+id+'/'+rel,        
          
        });
        location.reload();
      }
    });
  });

</script>
<script>
  $(document).ready(function() {
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
      localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
      $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
  });
</script>
@endsection