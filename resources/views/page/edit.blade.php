@extends('layouts.admin.app')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Units</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard / Unit</li>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body"> 
                    <form action="{{ route('page.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ Crypt::encryptString($page->id) }}">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="page-tab" data-bs-toggle="tab" data-bs-target="#page-tab-pane" type="button" role="tab" aria-controls="page-tab-pane" aria-selected="true">Page</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="english-tab" data-bs-toggle="tab" data-bs-target="#english-tab-pane" type="button" role="tab" aria-controls="english-tab-pane" aria-selected="false">English</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="hindi-tab" data-bs-toggle="tab" data-bs-target="#hindi-tab-pane" type="button" role="tab" aria-controls="hindi-tab-pane" aria-selected="false">Hindi</button>
                        </li>
                        
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="page-tab-pane" role="tabpanel" aria-labelledby="page-tab" tabindex="0">
                            <label for="name">Name</label>
                            <div class="form-group">
                                <input type="text" name="name" id="" class="form-control" value="{{ printOldOrDbValue('name', $page) }}" />
                            </div>

                            <label for="name">Hindi Name</label>
                            <div class="form-group">
                                <input type="text" name="hi_name" id="" class="form-control" value="{{ printOldOrDbValue('hi_name', $page) }}" />
                            </div>

                            {{-- <label for="name">Seo Description</label>
                            <div class="form-group">
                                <textarea name="seo_description" class="form-control"></textarea>
                            </div>

                            <label for="name">Seo Keywords</label>
                            <div class="form-group">
                                <textarea name="seo_keywords" class="form-control"></textarea>
                            </div> --}}

                            <label for="name">Page CSS</label>
                            <div class="form-group">
                                <textarea name="page_css" class="form-control">{{printOldOrDbValue('page_css', $pageAsset)}}</textarea>
                            </div>

                            <label for="name">Page JS</label>
                            <div class="form-group">
                                <textarea name="page_js" class="form-control">{{printOldOrDbValue('page_js', $pageAsset)}}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="english-tab-pane" role="tabpanel" aria-labelledby="english-tab" tabindex="0">
                            <input type="hidden" name="language_en" value="en">
                            <label for="name">Title</label>
                            <div class="form-group">
                                <input type="text" name="title_en" id="" class="form-control" value="{{printOldOrDbValue('title', $default_translation)}}"/>
                            </div>

                            <label for="name">Heading</label>
                            <div class="form-group">
                                <input type="text" name="heading_en" class="form-control" value="{{printOldOrDbValue('heading', $default_translation)}}"/>
                            </div>

                            <label for="name">Content</label>
                            <div class="form-group">
                                
                                <textarea name="main_content_en" class="form-control editor">{{base64_decode(printOldOrDbValue('main_content', $default_translation))}}</textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="hindi-tab-pane" role="tabpanel" aria-labelledby="hindi-tab" tabindex="0">
                            <input type="hidden" name="language_hi" value="hi">
                            <label for="name">Title</label>
                            <div class="form-group">
                                <input type="text" name="title_hi" id="" class="form-control" value="{{printOldOrDbValue('title', $hindi_translation)}}"/>
                            </div>

                            <label for="name">Heading</label>
                            <div class="form-group">
                                <input type="text" name="heading_hi" id="" class="form-control" value="{{printOldOrDbValue('heading', $hindi_translation)}}"/>
                            </div>

                            <label for="name">Hindi Content</label>
                            <div class="form-group">
                                <textarea name="main_content_hi" class="form-control editor">{{base64_decode(printOldOrDbValue('main_content', $hindi_translation))}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="status" {{printOldOrDbValue('status', $page) == '1' ? 'checked' : ''}} />
                        <label class="form-check-label" for="flexCheckChecked">
                          Publish
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function(){
        CKEDITOR.replaceAll('editor');
    });
</script>
@endpush 