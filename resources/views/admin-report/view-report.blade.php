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
                <h1 class="m-0">MSF Admin Report's</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / MSF Admin Report's</li>
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
            <h6> MSF Admin Report's</h6>
        </div>
        <div class="card-body">
            <!-- <div class="tab" id="myTab">
                <button class="tablinks" onclick="openCity(event, 'America')">MSF Admin Report</button>

            </div> -->

            <!-- Tab content -->


            <h3>Admin Report's</h3>

            <div class="row mt-2 p-1">
                @if(AUTH::user()->user_type !='15')
                <div class="col-md-12">
                    <div style="float:right">
                        <button type="button" href="{{url()->previous()}}" class="btn btn-primary addmorebtn">Back</button>
                    </div>
                </div>
                @endif
                <div class="col-md-12">
                    <div class="card bgcard p-2">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form method="POST" action="{{route('search-admin-report')}}">
                                    <table class="table table-stripped">
                                        <thead class="text-center">
                                            <tr>
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
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            <td>
                                                @csrf
                                                <input type="hidden" value="search" name="action" />
                                                <select class="form-control" name="unit_id">
                                                    <option value="">---select unit---</option>
                                                    @if(AUTH::user()->unit_id ==0)
                                                    <option value="0">Yantra India Limited (यंत्र इंडिया लिमिटेड)</option>
                                                    @foreach($unit as $u)
                                                    <option value="{{$u->id}}">{{$u->en_unit_name}}({{$u->hi_unit_name}})</option>
                                                    @endforeach
                                                    @else
                                                    @foreach($unit as $u)
                                                    @if(AUTH::user()->unit_id ==$u->id)
                                                    <option selected value="{{$u->id}}">{{$u->en_unit_name}}({{$u->hi_unit_name}})</option>
                                                    @else
                                                    <option disabled value="{{$u->id}}">{{$u->en_unit_name}}({{$u->hi_unit_name}})</option>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                </select>

                                            </td>
                                            <td>
                                                <input type="date" class="form-control" required name="date_from" />
                                                {{--<select class="form-control" name="financial_year">
                                <option value="">---select financial year---</option>
                                @foreach($financial_year as $y)
                                <option value="{{$y->id}}">{{$y->years}}</option>

                                                @endforeach
                                                </select>--}}

                                            </td>
                                            <td>
                                                <input type="date" class="form-control" required name="date_to" />
                                                {{--<select class="form-control" name="financial_year">
                                <option value="">---select financial year---</option>
                                @foreach($financial_year as $y)
                                <option value="{{$y->id}}">{{$y->years}}</option>

                                                @endforeach
                                                </select> --}}

                                            </td>
                                            <td><input type="submit" value="Search" class="btn btn-primary" name="name" /></td>
                                        </tbody>

                                    </table>
                                </form>

                            </div>


                        </div>
                        @if($action =='View')
                        <div class="col-md-12">
                            @if($count > 0)
                            <table class="table  table-responsive">
                                <thead>
                                    <th>Date From</th>
                                    <th>Date To</th>
                                    <th>Report Type</th>
                                    <th>Report</th>
                                </thead>
                                <tbody>
                                    @foreach($reportdata as $rd)
                                    <tr>
                                        <td>{{$rd->date_from ??''}}</td>
                                        <td>{{$rd->date_to ??''}}</td>
                                        <td>{{$rd->report_type}}</td>
                                        <td><a href="{{asset($rd->report_file)}}" class="btn btn-primary" target="_blank">VIEW</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <h5 class="mt-2 text-center">No Records Found...</h5>

                            @endif
                        </div>
                        @endif
                    </div>

                </div>
            </div>






            <!----------------------------------------->

        </div>
    </div>
</div>
</div>
<!-----------------------------------------MODALS---------------------------------------------->

<!-------------------------------------end Products-------------------------------------------------->

<!-------------------------------------------------Edit Modal--------------------------------------------------------------->
<div class="modal fade editmodalbyajax" id="exampleEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

</div>
<!--------------------------------------------------------Approve Modal----------------------------------------------------------->
<div class="modal fade" id="approvecontent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approval</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Publish AT</label>
                        <input type="datetime-local" class="dateTimePicker form-control publish_time" name="date-time" />
                        <input type="hidden" name="rel" class="relation" />
                        <input type="hidden" name="relid" class="relid" />
                    </div>
                    <div class="form-group">
                        <label>Enter OTP</label>
                        <input type="text" required placeholder="Enter OTP" class="form-control otpval" name="otp" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveapproval">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------Review Modal------------------------------------------------------------>
<div class="modal fade" id="reviewcontent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea class="form-control remarks" required name="remarks"></textarea>
                        <input type="hidden" name="rel" class="review_relation" />
                        <input type="hidden" name="relid" class="review_relid" />
                    </div>
                    <div class="form-group">
                        <label>Enter OTP</label>
                        <input type="text" required placeholder="Enter OTP" class="form-control reviewotpval" name="otp" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary savereview">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------->

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


    $('body').on('click', '.editfinancemodal', function() {
        var pro_id = $(this).attr('rel');
        $.ajax({
            type: 'Get',
            enctype: 'multipart/form-data',
            url: "{{ url('edit-admin')}}" + '/' + pro_id,
            success: function(data) {
                $('.editmodalbyajax').html(data);
                $('.editmodalbyajax').modal('show');
                // CKEDITOR.replace('edit_manu_description');
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