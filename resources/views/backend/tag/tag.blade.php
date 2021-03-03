@extends('backend.master.master2')
@section('title','Trang chủ')
@section('content')
<!-- Start Content-->
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="form-inline">
                    <button id="click" type="button" class="btn btn-info btn-sm " style="display:none"><?php echo __('Delete') ?></button>
                        <div class="form-group ml-1">
                            <div class="input-group input-group-sm">
                                <select class="selectpicker show-tick" id="id_show_tag" data-style="btn-light">
                                <option selected value="">Ngôn ngữ</option>
                                    @foreach( $language as $l )
                                    @if($l->name == $tmp)
                                    <option selected value="{{$l->id}}">{{$l->name}}</option>
                                    @else
                                    <option value="{{$l->id}}">{{$l->name}}</option>
                                    @endif
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-2" data-iziModal-open="#modaladdtag">
                            <i class="mdi mdi-plus"></i><strong> <?php echo __('Add') ?></strong>
                        </a>
                    </form>
                </div>
                <h4 class="page-title"><?php echo __('List Tag') ?></h4>
            </div>
        </div>
    </div>
    @if(Cookie::get('200'))
    <input type="text" value="{{Cookie::get('200')}}" id="tag" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongThemT">Click
        me</button>
    @endif
    @if(Cookie::get('201'))
    <input type="text" value="{{Cookie::get('201')}}" id="tags" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongSuaT">Click
        me</button>
    @endif
    @if(Cookie::get('202'))
    <input type="text" value="{{Cookie::get('202')}}" id="tagx" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongXoaT">Click
        me</button>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                        <th><input type="checkbox" id="checkall"> <?php echo __('All') ?></th>
                            <th style="width:7%">#</th>
                            <th><?php echo __('Tag') ?></th>
                            <th><?php echo __('Language') ?></th>
                            <th>Slug</th>
                            <th style="width: 10%"><?php echo __('Action') ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tags as $key => $item)
                        <tr>
                        <td><input type="checkbox" id="checks" class="abc_Checkbox" name="check[]" value="{{$item->id}}"></td>
                            <td>#{{$key + 1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{App\Models\Language::find($item->language_id)->name}}</td>
                            <td>{{$item->slug}}</td>
                            <td>
                                <a href="javascript: void(0);" title="<?php echo __('Edit') ?>" id="btn-edit-tag" class="action-icon" data-tag="{{$item->name}}" data-language="{{$item->language_id}}" data-id="{{$item->id}}" data-slug="{{$item->slug}}" data-iziModal-open="#modal-edit-tag"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <a href="javascript: void(0);" title="<?php echo __('Delete') ?>" class="action-icon" id="btn-delete-tag" data-id="{{$item->id}}"> <i class="mdi mdi-delete"></i></a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Form Edit Tag --}}
    <div id="modal-edit-tag" class="izi-tag" data-izimodal-loop="" data-izimodal-title="<?php echo __('Edit Tag') ?>">
        <div class="">
            <form style="padding:2% 0 2% 0;margin:0 auto">
                <input type="hidden" id="tag-id">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="inputState" class="col-form-label d-block"><?php echo __('Language') ?></label>
                                <select name="language_id" id="language_id" class="form-control" required="required">
                                    @foreach($language as $l)
                                    <option value="{{$l->id}}">{{$l->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label" for="tag-edit"><?php echo __('Tag') ?>:</label>
                                <div id="htnr">
                                    <input type="text" id="tag-edit" name="name" class="form-control" required>
                                </div>
                                <div style="margin-top: 12px" id="div-error-tag-edit">
                                    <i><strong type="text" id="error-tag-edit" class="text-danger"></strong></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label" for="tag-edit">Slug</label>
                                <div id="htnr">
                                    <input type="text" id="slug-edit" name="slug" class="form-control" required>
                                </div>
                                <div style="margin-top: 12px" id="div-error-slug-edit">
                                    <i><strong type="text" id="error-slug-edit" class="text-danger"></strong></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" id="btn-submit-edit-tag" class="btn btn-primary waves-effect waves-light them">+ <?php echo __('Edit') ?></button>
                        <button type="button" class="btn btn-danger waves-effect waves-light" data-izimodal-close><?php echo __('Cancel') ?></button>
                    </div>
                </div> <!-- end col -->
            </form>
        </div>
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
                                <select name="language_id" id="languageid" class="form-control" required="required">
                                    @foreach($language as $l)
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
                                <label class="col-form-label" for="MauWeb">Slug:</label>
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

</div> <!-- End content -->

@endsection

<!-- Khai báo js -->
@section('showJS')
<script src="backend\assets\js\LongJS\Page-Tag.js"></script>
@endsection