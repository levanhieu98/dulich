@extends('backend.master.master3')
@section('title','Sửa Tour')
@section('content')
@section('showCSS')

<link href="backend\assets\css\izi.css" rel="stylesheet">
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
                <h4 class="page-title"><?php echo __('Edit tour') ?></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form action="{{route('tourist.getupdate',$tour->id)}}" id="form-edit-tour" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-3 ">
                            <label for="inputState" class="col-form-label"><?php echo __('Language') ?></label>
                            <select class="selectpicker" data-live-search="true" data-selected-text-format="count > 3" data-style="btn-light" name="language_id">
                                @foreach($language as $l)
                                <option {{$tour->language_id==$l->id?"selected":""}} value="{{$l->id}}">{{$l->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3 col-3 ">
                            <label for="inputState" class="col-form-label">Thể loại</label>
                            <select class="selectpicker" data-live-search="true" data-selected-text-format="count > 3" data-style="btn-light" name="type_of_tour_id">
                                @foreach($typeOfTour as $type)
                                <option {{$tour->type_of_tour_id == $type->id ? "selected" : ""}} value="{{$type->id}}">
                                    {{$type->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Avatar') ?></label></br>
                        <div class="text-center mb-1"><img class="mt-1 mb-1 " id="output" style=" border-radius: 8px;
        width:360px;
        height:255px;" src="img/original/{{$tour->images}}" /></div>
                        <input type="file" accept="image/*" name="image" id="file_image" onchange="loadFile(event)">
                    </div>
                    <div class="form-group mb-3">
                        <label for="simpleinput"><?php echo __('Title') ?></label>
                        <textarea name="title" id="" class="form-control @error('title') is-invalid @enderror" cols="138" rows="5">{{$tour->title}}</textarea>
                        @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo __('Content') ?></label>
                        <textarea name="content" required class="form-control" id="content_tour">{!!$tour->content!!}</textarea>
                        <div id="erorr_cont"></div>
                    </div>

                    <div class="form-group">
                        <label>Ablum_tour</label>
                        <div id="preview" class="text-center mb-1">
                            @foreach($tour_img as $img)
                            <img src="img/album/{{$img->image}}" style="width: 100px;height:100px" alt="">
                            @endforeach
                        </div>
                        <input type="file" accept="image/*" id="file-input" class="form-control" multiple name="avatar[]">
                        @if ($errors->has('avatar'))
                        <span class="text-danger">{{ $errors->first('avatar') }}</span>
                        @endif

                    </div>
                    <div class="form-group">
                        <label><?php echo __('Location') ?></label>
                        <input type="text" class="form-control" value="{{$tour->location}}" name="location">
                    </div>
                    <div class="row"></div>
                    <div class="form-group ">
                        <label><?php echo __('Place') ?></label>
                        <input type="text" class="form-control" value="{{$tour->place}}" name="place">
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Date') ?></label>
                        <input type="text" class="form-control" value="{{$tour->date}}" name="date">
                    </div>
                    <div class="form-group">
                        <label><?php echo __('price') ?></label>
                        <input type="text" class="form-control" value="{{$tour->price}}" name="price">

                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" id="btn" class="btn btn-info"><?php echo __('Edit tour') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@section('showJS')
<script src="backend\assets\js\HieuJS\alerTour.js"></script>
<script src="backend\assets\js\HieuJS\vaidateform.js"></script>
<script src="backend\assets\js\HieuJS\tinymce.js"></script>
@endsection