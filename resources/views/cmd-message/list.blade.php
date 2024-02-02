@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">CMD Message</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / CMD Message</li>
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
                <a class="btn btn-primary" href="{{route('add-cmd-message')}}">Add CMD Message</a>
            </div>
        </div>
        <div class="col-sm-12">

            {!! displayAlert() !!}

            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>CMD Message</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <!-- {{--{!! dataTable->table() !!}--}} -->
                        <table class="table table-responsive table-striped datatable">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Image</th>
                                    <th  >Description (English)</th>
                                    <th>Description (Hindi)</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $a = 0; @endphp
                                @foreach($data as $dt)
                                <tr>
                                    <td>{{$a = $a+1}}</td>
                                    <td>@if($dt->image !='')
                                        <img src="{{asset($dt->image)}}" style="max-width:80px" />
                                        @endif
                                    </td>
                                    <td>{{$dt->en_description}}</td>
                                    <td>{{$dt->hi_description}}</td>
                                    <td>
                            @if($dt->status =='0' || $dt->status =='12')
                            Created
                            @elseif($dt->status =='1' || $dt->status =='13')
                            Approved
                            @elseif($dt->status =='2')
                            Sent By Super Admin To Review.
                            @elseif($dt->status == '3' || $dt->status =='11')
                            Submitted For Review
                            @elseif($dt->status =='4')
                            <span class="rejected">Rejected</span>
                            @endif
                          </td>
                          <td>
                            @if($dt->status =='12' || $dt->status =='11' || $dt->status =='13')
                            Deletion
                            @elseif($dt->type == '1')
                            Modification
                            @endif
                          </td>
                                    <td>{{$dt->remarks}}</td>
                                    <td>
                                        @if(AUTH::user()->user_type =='3')
                                        @if($dt->status == '1')
                                        <a href="{{route('edit-cmd-message',['id' => Crypt::encrypt($dt->id)])}}" type="button" class="btn btn-primary">Another Request</a>
                                        @elseif($dt->status == '2')
                                        <a href="{{route('cmd-preview',['id' => Crypt::encrypt($dt->id)])}}" class="btn btn-success">Preview</a>
                                        <a href="{{route('edit-cmd-message',['id' => Crypt::encrypt($dt->id)])}}" type="button" class="btn btn-primary">Edit</a>
                                        @elseif($dt->status == '12')
                                        <a href="{{route('request-for-delete-sent',['id' => Crypt::encrypt($dt->id),'tab'=>Crypt::encrypt('cmd_message_for_delete')])}}" class="btn btn-success">Submit For Review</a>
                                        <a href="{{route('edit-cmd-message',['id' => Crypt::encrypt($dt->id)])}}" type="button" class="btn btn-primary">Edit</a>
                                        <a class="btn btn-danger" href="{{route('del-content',['id' => $dt->id,'rel'=>'cmdmessage'])}}">Delete</a>
                                        @elseif($dt->status == '0')
                                        <a href="{{route('cmd-preview',['id' => Crypt::encrypt($dt->id)])}}" class="btn btn-success">Preview</a>
                                        <a href="{{route('submitforsuperadmin',['id' => Crypt::encrypt($dt->id),'tab'=>Crypt::encrypt('cmd_message')])}}" class="btn btn-success">Submit For Review</a> 
                                        <a href="{{route('edit-cmd-message',['id' => Crypt::encrypt($dt->id)])}}" type="button" class="btn btn-primary">Edit</a>
                                        <a class="btn btn-danger" href="{{route('del-content',['id' => $dt->id,'rel'=>'cmd_message'])}}">Delete</a>
                                        @endif
                                        @elseif(AUTH::user()->user_type=='9')
                                        @if($dt->status =='1')
                                        <span class="mt-2 p-2 bg-white text-dark">Approved {{$dt->publish_time}}</span>
                                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="mt-3 p-2 btn btn-success changeapprovesch">Change Approval Schedule</button>
                                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="mt-3 p-2 btn btn-danger cancelapproval">Cancel Approval</button>

                                        @elseif($dt->status =='2')
                                        Submitted For Review : {{$dt->remarks ??''}}
                                        @elseif($dt->status =='11')
                                        <button type="button" rel_id="{{$dt->id}}" rel="delete_request_cmdmessage" data-live_table_id="{{$dt->live_table_id}}" class="btn btn-success delete_request">Approve</button>
                                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="btn btn-danger reject">Reject</button>
                                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="btn btn-danger review">Review</button>

                                        @else
                                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="btn btn-success approve">Approve</button>
                                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="btn btn-danger reject">Reject</button>
                                        <button type="button" rel_id="{{$dt->id}}" rel="cmd_message" class="btn btn-danger review">Review</button>
                                        @endif
                                        @endif
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
</div>



@include('modal_and_jquery')




@endsection

@push('script')
{{--{{ $dataTable->scripts() }}--}}
@endpush