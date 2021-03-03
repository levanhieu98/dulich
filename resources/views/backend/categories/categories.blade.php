@extends('backend.master.master2')
@section('title','Danh sách thể loại')
@section('content')
<!-- Start Content-->
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="form-inline">
                    <button id="clicks" type="button" class="btn btn-info btn-sm " style="display:none"><?php echo __('Delete') ?></button>
                        <div class="form-group ml-1">
                            <div class="input-group input-group-sm">
                                <select class="show-tick form-control language" data-live-search="true" id="language_id"
                                    name="language" data-style="btn-light">
                                    <option value=" "><?php echo __('Language') ?></option>
                                    @foreach ($language as $item)
                                    @if($item->name==$tmp)
                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-2"
                            data-iziModal-open="#modal-add-category" id="btn-form-add-category">
                            <i class="mdi mdi-plus"></i><strong> <?php echo __('Add') ?></strong>
                        </a>
                    </form>
                </div>
                @include('errors.error')
                @if(Session::has('success'))
                <input type="text" value="{{Session::get('success')}}" id="category" class="d-none">
                <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none"
                    id="ThanhCongThem">Click
                    me</button>
                @endif
                @if(Session::has('successS'))
                <input type="text" value="{{Session::get('successS')}}" id="categorys" class="d-none">
                <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none"
                    id="ThanhCongSua">Click
                    me</button>
                @endif
                @if(Session::has('successx'))
                <input type="text" value="{{Session::get('successx')}}" id="categoryx" class="d-none">
                <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none"
                    id="ThanhCongXoa">Click
                    me</button>
                @endif
                <h4 class="page-title">Danh sách thể loại</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                        <th><input type="checkbox" id="checkalls"> <?php echo __('All') ?></th>
                            <th><?php echo __('Category') ?></th>
                            <th>Slug</th>
                            <th><?php echo __('By category') ?></th>
                            <th><?php echo __('Language') ?></th>
                            <th style="width:20%;"><?php echo __('Action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $item)
                        <tr>
                        <td><input type="checkbox" id="check" class="abc_Checkbox" name="check[]" value="{{$item->id}}"></td>
                            <td id="view-name-category-{{$item->id}}">{{$item->name}}</td>
                            <td id="view-slug-category-{{$item->id}}">{{$item->slug}}</td>
                            <td id="{{$item->parent_id}}">
                                {{($item->parent_id)>0?App\Models\Category::find($item->parent_id)->name:""}}</td>
                            <td id="{{$item->language_id}}">{{$item->language->name}}</td>
                            <td>
                                <a id="btn-edit-form-category" href="javascript: void(0);"
                                    data-IdCategory="{{$item->id}}" data-language="{{$item->language_id}}"
                                    data-Idparent="{{$item->parent_id}}" data-NameCategory="{{$item->name}}"
                                    data-iziModal-open="#modal-edit-catelory" title="Chỉnh sửa" class="action-icon"> <i
                                        class="mdi mdi-square-edit-outline"></i></a>
                                <a id="btn-delete-category" href="{{route('categoty.destroy',$item->id)}}"
                                    data-IdLanguage="{{$item->id}}" class="action-icon"> <i
                                        class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Form Add Category --}}
    <div id="modal-add-category" class="izi-category" data-izimodal-loop=""
        data-izimodal-title="<?php echo __('Add Category') ?>">
        <form action="{{route('categoty.store')}}" id="category_form" method="post"
            style="padding:2% 0 2% 0;margin:0 auto">
            @csrf
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="col-form-label" for="name-category"><?php echo __('Category') ?></label>
                            <div id="">
                                <input type="text" id="add-name" name="name"
                                    class="form-control @error('name') is-invalid @enderror ">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="col-form-label" for="slug">Slug:</label>
                            <div id="">
                                <input type="text" id="add-slug" name="slug"
                                    class="form-control @error('slug') is-invalid @enderror">
                                @if ($errors->has('slug'))
                                <span class="text-danger">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="col-form-label" for="add-language"><?php echo __('Language') ?>:</label>
                            <div>
                                <select class="show-tick form-control @error('language_id') is-invalid @enderror"
                                    data-live-search="true" id="add-language" name="language_id" data-style="btn-light"
                                    required>
                                    @foreach ($language as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
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
                                <select class="show-tick form-control" data-live-search="true" id="add-parent"
                                    name="parent_id" data-style="btn-light">
                                    <option  value="" ></option>
                                    @foreach ($category_cha as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" id="btn-add-category" class="btn btn-primary waves-effect waves-light">+
                        <?php echo __('Add') ?></button>
                    <button type="button" class="btn btn-danger waves-effect waves-light"
                        data-izimodal-close><?php echo __('Cancel') ?></button>
                </div>

            </div> <!-- end col -->
        </form>
    </div>

    {{-- Form Edit Category --}}
    <div id="modal-edit-catelory" class="izi-category" data-izimodal-loop="" data-izimodal-title="Chỉnh sửa thể loại">
        <form action="{{route('categoty.update')}}" id="category_form_edit" method="post"
            style="padding:2% 0 2% 0;margin:0 auto">
            @csrf
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="col-form-label" for="name-category">Thể loại</label>

                            <div id="">
                                <input type="hidden" id="id_category" name="id" class="form-control">
                                <input type="text" id="edit-name" name="name"
                                    class="form-control @error('name') is-invalid @enderror ">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="col-form-label" for="slug">Slug:</label>
                            <div id="">
                                <input type="text" id="edit-slug" name="slug"
                                    class="form-control @error('slug') is-invalid @enderror">
                                @if ($errors->has('slug'))
                                <span class="text-danger">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="col-form-label" for="parent">Theo thể loại:</label>
                            <div id="showSelectCategory1">
                                <select class="show-tick form-control" data-live-search="true" id="edit-parent"
                                    name="parent_id" data-style="btn-light">
                                    <option selected></option>
                                    @foreach ($category_cha as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label class="col-form-label" for="MauWeb">Ngôn ngữ:</label>
                            <div class="">
                                <select class="show-tick form-control @error('language_id') is-invalid @enderror"
                                    data-live-search="true" id="edit-language" name="language_id" data-style="btn-light"
                                    required>
                                    <option class="d-none" disabled>Ngôn ngữ</option>
                                    @foreach ($language as $item)
                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('language_id'))
                                <span class="text-danger">{{ $errors->first('language_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" id="btn-add-category" class="btn btn-primary waves-effect waves-light">+ Cập
                        nhật</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light"
                        data-izimodal-close>Hủy</button>
                </div>

            </div> <!-- end col -->

        </form>
    </div>
</div> <!-- End content -->

@endsection

@section('showJS')
<script src="backend\assets\js\HieuJS\validateH.js"></script>
<script src="backend\assets\js\LongJS\Page-Category.js"></script>
<script src="backend\assets\js\HieuJS\alertCategory.js"></script>
<script src="backend\assets\js\HieuJS\vaidateform.js"></script>
@endsection
