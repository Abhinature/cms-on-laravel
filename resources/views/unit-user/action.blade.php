<div class="btn-group">
    <a href="{{route('edit-unit-user',['id' => Crypt::encrypt($id)])}}" class="btn btn-primary btn-sm">Edit</a>
    <button class="hisoty_btn password-history" data-_id="{{Crypt::encrypt($id)}}">
        <i class="fas fa-info"></i>
    </button>
</div>