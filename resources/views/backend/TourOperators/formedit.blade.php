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

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form action="{{route('touroperator.update',$traveler->id)}}" id="form-create-edit" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex">
                        <div class="form-group mb-3 col-6 ">
                            <label for="inputState" class="col-form-label"><?php echo __('Language') ?></label>
                            <select class="selectpicker" data-live-search="true"  data-style="btn-light" name="language_id">
                                @foreach($language as $l)
                                <option {{$traveler->language_id==$l->id?"selected":""}} value="{{$l->id}}">{{$l->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="simpleinput" class="col-form-label"><?php echo __('Name') ?></label>
                            <input type="text" class="form-control" value="{{$traveler->name}}" name="name">
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group mb-3 col-6 ">
                            <label for="simpleinput" class="col-form-label"><?php echo __('Email') ?></label>
                            <input type="text" class="form-control" value="{{$traveler->email}}" name="email">
                        </div>
                        <div class="form-group mb-3 col-6">
                            <label for="simpleinput" class="col-form-label"><?php echo __('address') ?></label>
                            <input type="text" class="form-control" value="{{$traveler->address}}" name="address">
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group mb-3 col-6">
                            <label for="simpleinput" class="col-form-label"><?php echo __('phone') ?></label>
                            <input type="number" class="form-control" value="{{$traveler->phone}}" name="phone">
                        </div>
                        <div class="form-group mb-3 col-6 ">
                            <label for="simpleinput" class="col-form-label"><?php echo __('Link') ?></label>
                            <input type="text" class="form-control" value="{{$traveler->links}}" name="link">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?php echo __('Avatar') ?></label><br>
                        <div class="text-center mb-1"><img class="mt-1 mb-1 " src="img/original/{{$traveler->images}}" id="output" style=" border-radius: 8px;
        width:360px;
        height:255px;" /></div>
                        <input type="file"  accept="image/*" class="form-control" name="image" id="file_image" onchange="loadFile(event)">
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" id="btn" class="btn btn-info"><?php echo __('Edit Tour operators') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>



@endsection

@section('showJS')
<script src="backend\assets\js\HieuJS\vaidateform.js"></script>
<script src="backend\assets\js\HieuJS\toursoperators.js"></script>
{{-- editor js --}}
@endsection