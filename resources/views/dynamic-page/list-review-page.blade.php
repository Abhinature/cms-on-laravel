@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0">Pages</h3>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / Pages</li>
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
            <a class="btn btn-primary" href="{{url()->previous()}}">Back</a>
            </div>
            </div>
        <div class="col-sm-12">
            
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>List of Page's For Review</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th>S.No.</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Page Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Page Slug</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Parent Page</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Page Description</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Meta Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Meta Keyword</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Meta Description</th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder ">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">Action</th>
                                </tr>
                            </thead>
                            <tbody> @php
                                $a = 0;
                                @endphp

                                @foreach($data as $dt)
                                @php
                                $a = $a+1;
                                @endphp
                                <tr class="text-center">
                                    <td>{{$a}}</td>
                                    <td>
                                       {{$dt->page_title}}
                                    </td>
                                    <td>
                                       {{$dt->slug}}
                                    </td>
                                    <td>
                                       {{$dt->parent_page}}
                                    </td>
                                    <td>
                                       {{$dt->description}}
                                    </td>
                                    <td>
                                       {{$dt->meta_title}}
                                    </td>
                                    <td>
                                       {{$dt->meta_keyword}}
                                    </td>
                                    <td>
                                       {{$dt->meta_description}}
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                       @if($dt->status ==0 && $dt->submit_for_review==0)
                                       Kindly Submit For Review
                                       @elseif($dt->status ==0 && $dt->submit_for_review==1)
                                       Waiting For Approval
                                       @elseif($dt->status==1)
                                       Approved
                                       @elseif($dt->status == 2)
                                       Rejected
                                       @elseif($dt->status == 3)
                                       Published
                                       @elseif($dt->status == 4)
                                       In-Active
                                       @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                    
                                    @if(($dt->status == 1)||($dt->status == 4))
                                    <a href="{{route('publish-page',['id' => Crypt::encrypt($dt->id)])}}" class="btn btn-success">Publish</a> 
                                    <a href="{{route('unpublish-page',['id' => Crypt::encrypt($dt->id)])}}" class="btn btn-success">In-Active</a> 
                                    @else
                                    <a href="{{route('approve-page',['id' => Crypt::encrypt($dt->id)])}}" class="btn btn-success">Approve</a>     
                                    <a href="{{route('reject-page',['id' => Crypt::encrypt($dt->id)])}}" class="btn btn-danger">Reject</a>    
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








    @endsection