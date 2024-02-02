<table class="table">
    <thead>
        <tr>
            <th>Event</th>
            <th>Old Value</th>
            <th>New Value</th>
            <th>Ip Address</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @if( !empty($page) )
        @foreach($page as $key => $val)
            
            <tr>
                <td>{{ $val->event ?? '' }}</td>
                <td> @json($val->old_values) </td>
                <td> @json($val->new_values) </td>
                <td>{{ $val->ip_address ?? '' }}</td>
                <td>{{ $val->created_at ?? '' }}</td>
            </tr>
        @endforeach
        @else
            <tr>
                <td colspan="10" class="text-danger">No record founds !</td>
            </tr>
        @endif
    </tbody>
</table>