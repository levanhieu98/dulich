@extends('backend.master.master2')
@section('title','Chỉnh sửa blog')
@section('content')

@section('showCSS')
<link href="backend\assets\css\izi.css" rel="stylesheet">

<link href="backend\assets\libs\flatpickr\flatpickr.min.css" rel="stylesheet" type="text/css">
<link href="backend\assets\libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css">
<link href="backend\assets\libs\clockpicker\bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css">
<link href="backend\assets\libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
@endsection

<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?php echo __('Edit Blog') ?></h4>
            </div>
        </div>
    </div>
    @include('errors.error')
    @include('errors.success')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form action="{{route('blog.update')}}" id="form-edit-blog" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="description" name="description">
                    <input type="hidden" id="content" name="content">
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label for="inputState" class="col-form-label"><?php echo __('Language') ?></label>
                            <select class="selectpicker @error('role_id') is-invalid @enderror" data-live-search="true" data-selected-text-format="count > 3" data-style="btn-light" data-form="edit" id="lang_chon" name="language_id">
                                @foreach ($languages as $language)
                                <option value="{{ $language->id}}" {{$language->id==$id_languages->id?'selected':""}}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <p for="inputState" class="col-form-label">Đặt lịch đăng bài</p>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="switch">
                                        <input name="checked_publish[]" value="{{$publish_blog ? $publish_blog->published_at : ''}}" id="publish-checked" type="checkbox">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="col-md-8" id="picker-publish" style>
                                    <input type="text" value="{{$publish_blog ? date('d-m-Y H:i', strtotime( $publish_blog->published_at)) : ''}}" name="time_publish" id="datetime-datepicker" data-date-format="d-m-Y H:i" class="form-control flatpickr-input active" placeholder="Ngày và giờ" readonly="readonly">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputState" class="col-form-label"><?php echo __('Category') ?></label>
                            <div class="d-flex">
                                <div class="col-sm-7" id="categoryFormCreateBlog">
                                    <select class="selectpicker @error('role_id') is-invalid @enderror" data-live-search="true" data-selected-text-format="count > 3" data-style="btn-light" name="category_id">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id}}" {{$category->id==$id_category->id?'selected':""}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <a data-iziModal-open="#modal-add-category" class="text-primary action-icon mt-1" style="margin-left: -20px"><i class="fas fa-plus-circle"></i></a>
                                </div>
                            </div>
                            @if ($errors->has('category_id'))
                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                            @endif
                            <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongThem">Click
                                me</button>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputState" class="col-form-label"><?php echo __('Tag') ?></label>
                            <div class="d-flex">
                                <div class="col-sm-7" id="TagFormCreateBlog">
                                    <select class="selectpicker" data-live-search="true" data-toggle="select2" multiple="multiple" name="tags[]">
                                        @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" @foreach($id_tag as $id_tags){{$tag->id==$id_tags->tag_id?'selected':""}}@endforeach>{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-1">
                                    <a class="text-primary action-icon mt-1" data-iziModal-open="#modaladdtag" style="margin-left: -20px"><i class="fas fa-plus-circle"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="simpleinput"><?php echo __('Title') ?></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$blog->title}}">
                        <input type="hidden" name="id_blog" class="form-control @error('title') is-invalid @enderror" value="{{$blog->id}}">
                        @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo __('Description') ?></label>
                        <textarea name="description" required class="form-control" id="description_blog">{!!$blog->description!!}</textarea>
                        <div id="erorr_des"></div>
                    </div>

                    <div class="form-group">
                        <label for=""><?php echo __('Content') ?></label>
                        <textarea name="content" required class="form-control" id="content_blog">{!!$blog->content!!}</textarea>
                        <div id="erorr_cont"></div>
                    </div>

                    <div class="form-group">
                        <label><?php echo __('Avatar') ?></label></br>
                        <div class="text-center mb-1">
                            <img src="img/original/{{$blog->image}}" class="mt-1 mb-1 " id="image_blog" style=" border-radius: 8px;
        width:360px;
        height: 225px;" />
                        </div>
                        <input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" id="btn_blog" class="btn btn-info"><?php echo __('Btn_Edit') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Form Add Category --}}
<div id="modal-add-category" class="addIziCategory" data-izimodal-loop="" data-izimodal-title="<?php echo __('Add Category') ?>">
    <form action="{{route('categoty.store')}}" method="post" style="padding:2% 0 2% 0;margin:0 auto">
        @csrf
        <div class="col-lg-12">
            <div class="row">
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="name-category"><?php echo __('Category') ?></label>
                        <div id="">
                            <input type="text" id="add-name" name="name" class="form-control @error('name') is-invalid @enderror ">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div style="margin-top: 12px" id="div-error-tag-adda">
                            <i><strong type="text" id="error-category-add" class="text-danger"></strong></i>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="slug">Slug:</label>
                        <div id="">
                            <input type="text" id="add-slug" name="slug" class="form-control @error('slug') is-invalid @enderror">
                            @if ($errors->has('slug'))
                            <span class="text-danger">{{ $errors->first('slug') }}</span>
                            @endif
                        </div>
                        <div style="margin-top: 12px" id="div-error-tag-addb">
                            <i><strong type="text" id="error-slug-add" class="text-danger"></strong></i>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="add-language"><?php echo __('Language') ?>:</label>
                        <div>
                            <select class="show-tick form-control @error('language_id') is-invalid @enderror" data-live-search="true" id="add-language" name="language_id" data-style="btn-light" required>
                                @foreach ($languages as $item)
                                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('language_id'))
                            <span class="text-danger">{{ $errors->first('language_id') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="parent"><?php echo __('By category') ?></label>
                        <div id="showSelectCategory">
                            <select class="show-tick form-control" id="add-parent" data-live-search="true" name="parent_id" data-style="btn-light">
                                <option class="d-none" selected disabled></option>
                                @foreach ($category_cha as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" id="btn-add-category" class="btn btn-primary waves-effect waves-light">+ <?php echo __('Add') ?></button>
                <button type="button" class="btn btn-danger waves-effect waves-light" data-izimodal-close><?php echo __('Cancel') ?></button>
            </div>

        </div> <!-- end col -->
    </form>
</div>
{{-- Form add Tag --}}
<div id="modaladdtag" class="izi-tag" data-izimodal-loop="" data-izimodal-title="<?php echo __('Add Tag') ?>">
    <div class="">
        <form style="padding:2% 0 2% 0;margin:0 auto">
            <input type="hidden" id="tag-id">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="inputState" class="col-form-label d-block"><?php echo __('Language') ?></label>
                            <select name="language_id" data-live-search="true" id="languageid" class="form-control" required="required">
                                @foreach($languages as $l)
                                <option value="{{$l->id}}">{{$l->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="col-form-label" for="MauWeb"><?php echo __('Tag') ?>:</label>
                            <div id="htnr">
                                <input type="text" id="tag-add" name="name" class="form-control" required>
                            </div>
                            <div style="margin-top: 12px" id="div-error-tag-add">
                                <i><strong type="text" id="error-tag-add" class="text-danger"></strong></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="col-form-label" for="tag-slug">Slug:</label>
                            <div id="htnr">
                                <input type="text" id="tag-slug" name="slug" class="form-control" required>
                            </div>
                            <div style="margin-top: 12px" id="div-error-tag-add1">
                                <i><strong type="text" id="error-tag-add1" class="text-danger"></strong></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" id="btn-submit-add-tag" class="btn btn-primary waves-effect waves-light "><?php echo __('Add') ?></button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" data-izimodal-close><?php echo __('Cancel') ?></button>
                </div>
            </div> <!-- end col -->
        </form>
    </div>
</div>
@endsection

@section('showJS')

<!-- Plugins js-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkbox = document.querySelector('#publish-checked');
        let checked = document.getElementById('picker-publish')
        if (checkbox.value) {
            checkbox.setAttribute("checked", "true");
        } else {
            checked.style.display = "none";
        }
        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                checked.style.display = "block";
            } else {
                checked.style.display = "none";
            }
        });
    });
</script>
<script src="backend\assets\libs\flatpickr\flatpickr.min.js"></script>
<script src="backend\assets\libs\bootstrap-colorpicker\js\bootstrap-colorpicker.min.js"></script>
<script src="backend\assets\libs\clockpicker\bootstrap-clockpicker.min.js"></script>
<script src="backend\assets\libs\bootstrap-datepicker\js\bootstrap-datepicker.min.js"></script>
<script src="backend\assets\js\pages\form-pickers.init.js"></script>

<script src="backend\assets\js\HieuJS\validateH.js"></script>
<script type="text/javascript" src="backend/assets/js/tinymce/tinymce.min.js"></script>
<script src="backend\assets\js\LongJS\Page-Blog.js"></script>
<script src="backend\assets\js\HieuJS\vaidateform.js"></script>
<script src="backend\assets\js\HieuJS\tinymce.js"></script>
@endsection