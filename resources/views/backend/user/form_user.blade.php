@extends('backend.master.master3')
@section('title','Trang chủ')
@section('content')
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title"><?php echo __('Add_User') ?></h4>
            </div>
        </div>
    </div>
    @if(Session::has('success'))
    <input type="text" value="{{Session::get('success')}}" id="user" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongUser">Click
                        me</button>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="inputState" class="col-form-label"><?php echo __('Role') ?></label>
                        <select class="selectpicker @error('role_id') is-invalid @enderror" data-live-search="true" multiple=""
                            data-selected-text-format="count > 3" data-style="btn-light" name="role_id[]">
                            @foreach($role as $rl)
                            <option value="{{$rl->id}}">{{$rl->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role_id'))
                        <span class="text-danger">{{ $errors->first('role_id') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="simpleinput"><?php echo __('Full name') ?></label>
                        <input type="text" name="name" id="simpleinput"
                            class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="example-email">Email</label>
                        <input type="text" id="example-email" name="email"
                            class="form-control  @error('email') is-invalid @enderror" value="{{old('email')}}"
                            placeholder="Email">
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="example-password"><?php echo __('Password') ?></label>
                        <input data-parsley-equalto="#pass1" name="password" value="{{old('password')}}" type="password"
                            placeholder="Password" class="form-control @error('password') is-invalid @enderror"
                            id="passWord2" data-parsley-id="33" aria-describedby="parsley-id-33">

                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="example-fileinput"><?php echo __('Avatar') ?></label></br>
                        <img id="blah" accept="image/*" class="mb-1 d-none"  src="#" alt="your image" style="width:100px;
    border-radius: 10%" />
                        <input type="file" name="profile_photo_path" id="imgInp"
                            class=" mt-1 form-control-file @error('profile_photo_path') is-invalid @enderror">
                        @if ($errors->has('profile_photo_path'))
                        <span class="text-danger">{{ $errors->first('profile_photo_path') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button class="btn btn-info"><?php echo __('Add_User') ?></button>
                        </div>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>
@endsection
@section('showJS')
<script src="backend\assets\js\HieuJS\alertUser.js"></script>
@endsection
