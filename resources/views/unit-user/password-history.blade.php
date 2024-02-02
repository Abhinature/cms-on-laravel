
@if( !empty($passwordHistory) )
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
@else
@dd('asdasd asdd')
    <tr>
        <td class="text-danger text-center" colspan="10">No record found !</td>
    </tr>
@endif