@extends('backend.master.master2')
@section('title','Trang chủ')
@section('content')
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <button id="clicks" type="button" class="btn btn-info btn-sm " style="display:none"><?php echo __('Delete') ?></button>
                </div>
                <h4 class="page-title"><?php echo __('User') ?></h4>
            </div>
        </div>
    </div>
    @if(Session::has('successx'))
    <input type="text" value="{{Session::get('successx')}}" id="userx" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongXoaUser">Click
                        me</button>
    @endif
    @if(Session::has('successS'))
    <input type="text" value="{{Session::get('successS')}}" id="users" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongSuaUser">Click
                        me</button>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                        <th><input type="checkbox" id="checkall"> <?php echo __('All') ?></th>
                            <th style="width: 7%">Stt</th>
                            <th><?php echo __('Avatar') ?></th>
                            <th><?php echo __('Full name') ?></th>
                            <th><?php echo __('Role') ?></th>
                            <th style="width: 10%"><?php echo __('Action') ?></th>
                            <th class="d-none"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $key => $u)
                        <tr>
                        <td><input type="checkbox" id="checks" class="abc_Checkbox" name="check[]" value="{{$u->id}}"></td>
                            <td scope="row">{{ $key + 1 }}</td>
                            <td  class="imgs"><img src="images/{{$u->profile_photo_path}}" alt=""></td>
                            <td>{{$u->name}}</td>
                            <td>@foreach($u->roles as $rl)
                                {{$rl->name}} ,
                                @endforeach
                            </td>
                            <td>
                                <a href="" class="action-icon" id="suaUser" data-iziModal-open="#modal-update-user-{{$u->id}}"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <a href="{{route('user.destroy',$u->id)}}" id="delete" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                            </td>
                            <td class="d-none " id="test" >
                            <div id="modal-update-user-{{$u->id}}" class="izi3 " data-izimodal-loop="" data-izimodal-title="Sửa quản trị viên">
                                    <div class="">
                                        <form action="{{route('user.update',$u->id)}}" id="{{$u->id}}" method="post" enctype="multipart/form-data" style="padding:2% 0 2% 0;margin:0 auto">
                                            @csrf
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group mb-3">
                                                            <label for="inputState" class="col-form-label d-block"><?php echo __('Role') ?></label>
                                                            <select class="selectpicker @error('role_id') is-invalid @enderror" data-live-search="true" multiple="" data-selected-text-format="count > 3" data-style="btn-light" name="role_id[]">
                                                                @foreach($role as $rl)
                                                                <option {{ $u->hasRole($rl->name)?'selected':''}} value="{{$rl->id}}">{{$rl->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('role_id'))
                                                            <span class="text-danger">{{ $errors->first('role_id') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="simpleinput"><?php echo __('Full name') ?></label>
                                                            <input type="text" name="name" value="{{$u->name}}" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                                                            @if ($errors->has('name'))
                                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="example-email">Email</label>
                                                            <input type="email" value="{{$u->email}}" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Email">
                                                            @if ($errors->has('email'))
                                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group mb-3">
                                                            <label for="example-password"><?php echo __('Avatar') ?></label></br>
                                                            <img src="images/{{$u->profile_photo_path}}" id="anh"  class="form-control" style="width:100px ;height:100px" alt="">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <input type="file" id="IMG" accept="image/*" name="profile_photo_path" class="form-control-file @error('profile_photo_path') is-invalid @enderror">
                                                            @if ($errors->has('profile_photo_path'))
                                                            <span class="text-danger">{{ $errors->first('profile_photo_path') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col text-center mb-2">
                                                        <button type="submit" class="btn btn-success waves-light waves-effect"><?php echo __('Btn_Edit') ?></button>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                        </form>
                                    </div>
                                </div> <!-- End content -->
                            </td>
                        </tr>
                        <!-- sua -->

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div> <!-- End content -->
<script>
    $('[id^="suaUser"]').click(function(){
        $('[id^="test"]').removeClass();
    })
</script>
@endsection
@section('showJS')
<script src="backend\assets\js\HieuJS\alertUser.js"></script>
@endsection