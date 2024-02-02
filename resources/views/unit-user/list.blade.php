@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Unit Users</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / Unit Users</li>
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
                <a class="btn btn-primary" href="{{route('add-unit-user')}}">Add Unit User</a>
            </div>
    </div>
        <div class="col-sm-12">
            
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>List of Unit Users</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login History</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       
        <div class="modal-body">
            <table class="table table-sm">
                <thead >
                    <tr>
                        <th>#</th>
                        <th>Ip Address</th>
                        <th>Status</th>
                        <th>Login Time</th>
                        <th>Logout Time</th>
                    </tr>
                </thead>
                <tbody id="table_record">
                    {{-- @if( !empty($passwordHistory) )
                        @foreach($passwordHistory as $key => $val)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $val->ip_address ?? '' }}</td>
                                <td>
                                    @if( !empty($val->status) && ($val->status == 2) )
                                    Success
                                    @else
                                    Fail
                                    @endif
                                </td>
                                <td>{{ $val->created_at ?? '' }}</td>
                                <td>{{ $val->logout_at ?? '' }}</td>
                            </tr>
                        @endforeach
                    @endif --}}
                </tbody>                
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

@endsection

@push('script')
{{ $dataTable->scripts() }}
<script>
    $(document).ready(function(){
        $(document).on('click', '.password-history', function(){
            showLoader();
            var id = $(this).data('_id');
            $("#table_record").html('');
            $.ajax({
                type: 'GET',
                url: "{{ route('passHistory') }}",
                data: {id},
                success: function(response) {
                    if( response.status ) {
                        
                        $("#table_record").html(response.html);
                        $('#exampleModal').modal('show'); 
                    }
                },
                error: function(err) {
                    hideLoader();
                },
                complete: function() {
                    hideLoader();
                }
            });
        });
    });
</script>
@endpush 