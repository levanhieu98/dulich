@extends('backend.master.master3')
@section('title','Sửa khách sạn')
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
                <h4 class="page-title"><?php echo __('Edit hotel') ?></h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form action="{{route('hotel.update',$hotel->id)}}" id="hotel_update" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex">
                        <div class="form-group mb-3 col-md-6">
                            <label for="inputState" class="col-form-label"><?php echo __('Language') ?></label>
                            <select class="selectpicker @error('role_id') is-invalid @enderror" data-live-search="true" data-selected-text-format="count > 3" data-style="btn-light" data-form="edit" id="lang_chon" name="language_id">
                                @foreach ($languages as $language)
                                <option value="{{ $language->id}}" {{$language->id==$hotel->language_id?'selected':""}}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label class="col-form-label"><?php echo __('Name') ?></label>
                            <input type="text" class="form-control" value="{{$hotel->name}}" name="name">
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-6">
                            <label class="col-form-label"   ><?php echo __('address') ?></label>
                            <input type="text" class="form-control" value="{{$hotel->address}}" name="address">
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="inputState" class="col-form-label"><?php echo __('Rating') ?></label>
                            <select class="selectpicker " data-style="btn-light" name="rate">
                                <option value="1" data-content="<i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i>" {{($hotel->rating)==1?'selected':''}}></option>
                                <option value="2" data-content="<i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i>" {{($hotel->rating)==2?'selected':''}}></option>
                                <option value="3" data-content="<i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i>" {{($hotel->rating)==3?'selected':''}}></option>
                                <option value="4" data-content=" <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i>" {{($hotel->rating)==4?'selected':''}}></option>
                                <option value="5" data-content="<i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i> <i class='fas fa-star'  style='color:rgb(251, 255, 3)'></i>" {{($hotel->rating)==5?'selected':''}}></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><?php echo __('Avatar') ?></label><br>
                        <div class="text-center mb-1"><img class="mt-1 mb-1 " id="output" style=" border-radius: 8px;
        width:360px;
        height:255px;" src="./img/original/{{$hotel->banner}}" /></div>
                        <input type="file" accept="image/*" class="form-control" name="image" id="file_image" onchange="loadFile(event)">
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo __('Description') ?></label>
                        <textarea name="description" class="form-control" id="content_tour">{!!$hotel->description!!}</textarea>
                        <div id="erorr_cont"></div>
                    </div>
                    <div class="form-group">
                        <label>Ablum_Hotel</label>
                        <div id="preview" class="text-center mb-1">
                            @foreach($album as $ig)
                            <img src="img/album/{{$ig->album}}" style="width: 100px;height:100px" alt="">
                            @endforeach
                        </div>
                        <input type="file" accept="image/*" id="file-input" class="form-control" name="avatar[]" multiple>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" id="btn" class="btn btn-info"><?php echo __('Edit hotel') ?></button>
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
<script src="backend\assets\js\HieuJS\hotel.js"></script>
<script src="backend\assets\js\HieuJS\tinymce.js"></script>
<script src="backend\assets\js\HieuJS\vaidateform.js"></script>
@endsection