@extends('backend.master.master3')
@section('title','Thêm Tour')
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
                <h4 class="page-title"><?php echo __('Add Tour') ?></h4>
            </div>
        </div>
    </div>
    @include('errors.error')
    @if(Session::has('success'))
    <input type="text" value="{{Session::get('success')}}" accept="image / *" id="tour" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongThemT">Click
        me</button>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form action="{{route('tourist.store')}}" id="form-create-tour" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group mb-3 col-3 ">
                            <label for="inputState" class="col-form-label"><?php echo __('Language') ?></label>
                            <select class="selectpicker" data-live-search="true" data-selected-text-format="count > 3" data-style="btn-light" name="language_id">
                                @foreach($language as $l)
                                <option value="{{$l->id}}">{{$l->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3 col-3 ">
                            <label for="inputState" class="col-form-label">Thể loại</label>
                            <select class="selectpicker" data-live-search="true" data-selected-text-format="count > 3" data-style="btn-light" name="type_of_tour_id">
                                @foreach($typeOfTour as $type)
                                <option value="{{$type->id}}">{{$type->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Avatar') ?></label><br>
                        <div class="text-center mb-1"><img class="mt-1 mb-1 d-none" id="output" style=" border-radius: 8px;
        width:360px;
        height:255px;" /></div>
                        <input type="file" accept="image/*" class="form-control" name="image" id="file_image" onchange="loadFile(event)">
                        @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                    </div>



                    <div class="form-group mb-3">
                        <label for="simpleinput"><?php echo __('Title') ?></label>
                        <textarea name="title" id="title1" class="form-control @error('title') is-invalid @enderror" cols="138" rows="5">{{old('title')}}</textarea>
                        @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for=""><?php echo __('Content') ?></label>
                        <textarea name="content" required class="form-control" id="content_tour"></textarea>
                        <div id="erorr_cont"></div>
                    </div>

                    <div class="form-group">
                        <label>Ablum_Tour</label>
                        <div id="preview" class="text-center mb-1"></div>
                        <input type="file" accept="image/*" id="file-input" class="form-control" name="avatar[]" required multiple>
                        @if ($errors->has('avatar'))
                        <span class="text-danger">{{ $errors->first('avatar') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label><?php echo __('Location') ?></label>
                        <input type="text" class="form-control" value="{{old('location')}}" required name="location">
                    </div>
                    <div class="row"></div>
                    <div class="form-group ">
                        <label><?php echo __('Place') ?></label>
                        <input type="text" class="form-control" value="{{old('place')}}" required name="place">
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Date') ?></label>
                        <input type="text" class="form-control" value="{{old('date')}}" required name="date">
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Price ') ?></label>
                        <input type="text" class="form-control" id="pri" value="{{old('price')}}" required name="price">
                        @if ($errors->has('contact'))
                        <span class="text-danger">{{ $errors->first('contact') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" id="btn" class="btn btn-info"><?php echo __('Add Tour') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>



@endsection

@section('showJS')
<script src="backend\assets\js\HieuJS\tinymce.js"></script>
<script src="backend\assets\js\HieuJS\alerTour.js"></script>
<script src="backend\assets\js\HieuJS\vaidateform.js"></script>
{{-- editor js --}}
@endsection