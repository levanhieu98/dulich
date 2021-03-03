@extends('backend.master.master3')
@section('title','Sửa nhà hàng')
@section('content')
@section('showCSS')
<link href="backend\assets\libs\flatpickr\flatpickr.min.css" rel="stylesheet" type="text/css">
<link href="backend\assets\libs\bootstrap-colorpicker\css\bootstrap-colorpicker.min.css" rel="stylesheet"
    type="text/css">
<link href="backend\assets\libs\clockpicker\bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css">
<link href="backend\assets\libs\bootstrap-datepicker\css\bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
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
                <h4 class="page-title"><?php echo __('Edit restaurant') ?></h4>
            </div>
        </div>
    </div>
    @include('errors.error')
    @if(Session::has('success'))
    <input type="text" value="{{Session::get('success')}}" accept="image / *" id="res" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongThemR">Click
        me</button>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form action="{{route('restaurant.update',$res->id)}}" id="form-edit-restaurant" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex">
                         <div class="form-group mb-3 col-md-6">
                            <label for="inputState" class="col-form-label"><?php echo __('Language') ?></label>
                            <select class="selectpicker @error('role_id') is-invalid @enderror" data-live-search="true" data-selected-text-format="count > 3" data-style="btn-light" data-form="edit" id="lang_chon" name="language_id">
                                @foreach ($languages as $language)
                                <option value="{{ $language->id}}" {{$language->id==$res->language_id?'selected':""}}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label  class="col-form-label"><?php echo __('Name') ?></label>
                            <input type="text" class="form-control" value="{{$res->name}}" name="name">
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-6">
                            <label class="col-form-label"><?php echo __('address') ?></label>
                            <input type="text" class="form-control" value="{{$res->address}}" name="address">
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="inputState" class="col-form-label"><?php echo __('Rating') ?></label>
                            <select class="selectpicker " data-style="btn-light" name="rate">
                                <option value="1" data-content="<i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i>" {{($res->rating)==1?'selected':''}}></option>
                                <option value="2" data-content="<i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i>" {{($res->rating)==2?'selected':''}}></option>
                                <option value="3" data-content="<i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i>" {{($res->rating)==3?'selected':''}}></option>
                                <option value="4" data-content=" <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i>" {{($res->rating)==4?'selected':''}}></option>
                                <option value="5" data-content="<i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i>" {{($res->rating)==5?'selected':''}}></option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-6 ">
                            <label><?php echo __('Time') ?></label>
                            <div class="input-group clockpicker inputWithIcon inputIconBg  " data-placement="top"
                                data-align="top" data-autoclose="true">
                                <input type="text" class="form-control" value="{{$start}}" name="time" style="width:100%">
                            </div>
                        </div>
                        <div class="form-group col-6 ">
                            <label>&nbsp</label>
                            <div class="input-group clockpicker  inputWithIcon inputIconBg" data-placement="top"
                                data-align="top" data-autoclose="true">
                                <input type="text" class="form-control" value="{{$end}}" name="time1"  style="width:100%">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><?php echo __('Avatar') ?></label><br>
                        <div class="text-center mb-1"><img class="mt-1 mb-1 " id="output" style=" border-radius: 8px;
        width:360px;
        height:255px;" src="img/original/{{$res->banner}}" /></div>
                        <input type="file" accept="image/*" class="form-control" name="image" id="file_image"
                            onchange="loadFile(event)">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo __('Content') ?></label>
                        <textarea name="description" required class="form-control"
                            id="content_tour">{!!$res->description!!}</textarea>
                        <div id="erorr_cont"></div>
                    </div>
                    <div class="form-group">
                        <label>Ablum_Restaurant</label>
                        <div id="preview" class="text-center mb-1">
                            @foreach($img as $ig)
                            <img src="img/album/{{$ig->album}}" style="width: 100px;height:100px" alt="">
                            @endforeach
                        </div>
                        <input type="file" accept="image/*" id="file-input" class="form-control" name="avatar[]"
                            multiple>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" id="btn"
                                class="btn btn-info"><?php echo __('Edit restaurant') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('showJS')

<!-- Plugins js-->
<script src="backend\assets\libs\flatpickr\flatpickr.min.js"></script>
<script src="backend\assets\libs\bootstrap-colorpicker\js\bootstrap-colorpicker.min.js"></script>
<script src="backend\assets\libs\clockpicker\bootstrap-clockpicker.min.js"></script>
<script src="backend\assets\libs\bootstrap-datepicker\js\bootstrap-datepicker.min.js"></script>

<!-- Init js-->
<script src="backend\assets\js\HieuJS\restaurant.js"></script>
<script src="backend\assets\js\pages\form-pickers.init.js"></script>
<script src="backend\assets\js\HieuJS\tinymce.js"></script>
<script src="backend\assets\js\HieuJS\vaidateform.js"></script>
{{-- editor js --}}
@endsection
