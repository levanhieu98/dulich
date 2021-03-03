@extends('backend.master.master3')
@section('title','Sửa món ăn')
@section('content')
@section('showCSS')
<style>
    #preview img {
        margin-right: 10px;
        margin-top: 10px;
        width: 100px;
        border-radius: 8px;
    }
</style>

@endsection
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?php echo __('Edit food') ?></h4>
            </div>
        </div>
    </div>
    @include('errors.error')
    @if(Session::has('success'))
    <input type="text" value="{{Session::get('success')}}" accept="image / *" id="res" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongThemF">Click
        me</button>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form action="{{route('food.update',$food->id)}}" id="form-edit-restaurant" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3 col-12">
                            <label for="inputState" class="col-form-label"><?php echo __('Language') ?></label>
                            <select class="selectpicker @error('role_id') is-invalid @enderror" data-live-search="true" data-selected-text-format="count > 3" data-style="btn-light" data-form="edit" id="lang_chon" name="language_id">
                                @foreach ($languages as $language)
                                <option value="{{ $language->id}}" {{$language->id==$food->language_id?'selected':""}}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="d-flex">
                        <div class="form-group col-6">
                            <label><?php echo __('Name') ?></label>
                            <input type="text" class="form-control" value="{{$food->name}}" name="name">
                        </div>
                        <div class="form-group col-6">
                            <label><?php echo __('address') ?></label>
                            <input type="text" class="form-control" value="{{$food->address}}" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Avatar') ?></label><br>
                        <div class="text-center mb-1"><img class="mt-1 mb-1 " id="output" style=" border-radius: 8px;
        width:360px;
        height:255px;"  src="img/original/{{$food->banner}}" /></div>
                        <input type="file" accept="image/*" class="form-control" name="image" id="file_image" onchange="loadFile(event)">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo __('Content') ?></label>
                        <textarea name="description" required class="form-control"  id="content_tour">{!!$food->description!!}</textarea>
                        <div id="erorr_cont"></div>
                    </div>
                    <div class="form-group">
                        <label>Ablum_Food</label>
                        <div id="preview" class="text-center mb-1">
                          @foreach($img as $imgs)
                            <img src="img/album/{{$imgs->album}}" style="width: 100px;height:100px" alt="">
                          @endforeach
                        </div>
                        <input type="file" accept="image/*" id="file-input" class="form-control" name="avatar[]"  multiple>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" id="btn" class="btn btn-info"><?php echo __('Edit food') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('showJS')
<!-- Init js-->
<script src="backend\assets\js\HieuJS\food.js"></script>
<!-- <script src="backend\assets\js\pages\form-pickers.init.js"></script> -->
<script src="backend\assets\js\HieuJS\tinymce.js"></script>
<script src="backend\assets\js\HieuJS\vaidateform.js"></script>
{{-- editor js --}}
@endsection