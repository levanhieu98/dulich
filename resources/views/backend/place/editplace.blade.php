@extends('backend.master.master3')
@section('title','Sửa địa điểm')
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
                <h4 class="page-title"><?php echo __('Edit place') ?></h4>
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
                <form action="{{route('place.update',$place->id)}}" id="hotel_update" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-12">
                            <label for="inputState" class="col-form-label"><?php echo __('Language') ?></label>
                            <select class="selectpicker" data-live-search="true"  id="lang_chon" data-style="btn-light" name="language_id">
                                @foreach ($languages as $l)
                                        <option value="{{$l->id}}" {{$l->id==$place->language_id?'selected':""}}>{{$l->name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-6">
                            <label><?php echo __('Name') ?></label>
                            <input type="text" class="form-control" value="{{$place->name}}" name="name">
                        </div>
                        <div class="form-group col-6">
                            <label><?php echo __('address') ?></label>
                            <input type="text" class="form-control" value="{{$place->address}}" name="address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Avatar') ?></label><br>
                        <div class="text-center mb-1"><img class="mt-1 mb-1 " id="output" style=" border-radius: 8px;
        width:360px;
        height:255px;" src="./img/original/{{$place->banner}}" /></div>
                        <input type="file" accept="image/*" class="form-control" name="image" id="file_image" onchange="loadFile(event)">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo __('Content') ?></label>
                        <textarea name="description" required class="form-control" id="content_tour">{!!$place->description!!}</textarea>
                        <div id="erorr_cont"></div>
                    </div>
                    <div class="form-group">
                        <label>Ablum_Place</label>
                        <div id="preview" class="text-center mb-1">
                        @foreach($album as $imgs)
                            <img src="img/album/{{$imgs->album}}" style="width: 100px;height:100px" alt="">
                          @endforeach
                        </div>
                        <input type="file" accept="image/*" id="file-input" class="form-control" name="avatar[]"  multiple>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" id="btn" class="btn btn-info"><?php echo __('Edit place') ?></button>
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
<script src="backend\assets\js\HieuJS\place.js"></script>
<script src="backend\assets\js\HieuJS\tinymce.js"></script>
<script src="backend\assets\js\HieuJS\vaidateform.js"></script>
{{-- editor js --}}
@endsection