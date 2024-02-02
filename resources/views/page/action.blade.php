<a href="{{ route('page.edit', ['id' => Crypt::encryptString($id)]) }}" class="btn btn-primary">
    Edit
</a>
@if( !empty($model->audits) )
    <button class="hisoty_btn" data-id="{{ Crypt::encryptString($id) }}" data-url="{{ route('page.get-page-history') }}" >
        <i class="fas fa-info"></i>
    </button>
@endif
