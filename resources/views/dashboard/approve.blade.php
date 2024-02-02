@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Approvals</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / Page</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<div class="container-fluid py-4">
    <div class="card">
        <table class="card-body table">
            <thead>
            <tr>
                <th scope="col">S.no</th>
                <th scope="col">Section</th>
                <th scope="col">Content</th>
                <th scope="col">Content Type</th>
                <th scope="col">Requested By</th>
                <th scope="col">Requested On</th>
                <th scope="col">Approved By</th>
                <th scope="col">Approved On</th>
            </tr>
            </thead>
            <tbody>
                @if( !empty($data) )
                    @foreach($data as $key => $val)
                        <tr>
                        <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $val['table_name'] ? tableNameToReadableName($val['table_name']) : '' }}</td>
                            <td>{{ Str::limit($val['title'], 40) }}</td>
                <td>
                    @if($val['type']=='1')
                        Modification
                    @elseif($val['type']=='2')
                        Deletetion
                    @else
                        Created
                    @endif
                </td>
                <td>{{ $val['created_by'] ? fetchingSingleValue('unit_users', 'unit_id', $val['created_by'], 'email') : '' }}</td>
                <td>{{ $val['created_at'] ? \Carbon\Carbon::parse($val['created_at'])->format('d/m/Y') : '' }}</td>
                <td>{{ $val['action_by'] ? fetchingSingleValue('unit_users', 'unit_id', $val['action_by'], 'email') : '' }}</td>
                <td>{{ $val['action_date'] ? \Carbon\Carbon::parse($val['action_date'])->format('d/m/Y') : '' }}</td>
               
                           
                            
                            
                         
                            
                        </tr>
                    @endforeach
                @else
                    <tr class="text-danger" colspan="10"><td>No Record founds !</td></tr>
                @endif
            
            </tbody>
        </table>
    </div>
</div>


@endsection