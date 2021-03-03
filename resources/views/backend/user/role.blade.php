@extends('backend.master.master2')
@section('title','Danh sách ngôn ngữ')
@section('content')

<!-- Start Content-->
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">

                    <form class="form-inline">
                        <button id="click" type="button" class="btn btn-info btn-sm " style="display:none"><?php echo __('Delete') ?></button>
                        <div class="form-group ml-1 ">
                            <a href="javascript: void(0);" class="btn btn-blue btn-sm " data-iziModal-open="#modaladdrole">
                                <i class="mdi mdi-plus"></i><strong> Thêm</strong>
                            </a>
                        </div>
                    </form>
                </div>
                <h4 class="page-title"><?php echo __('List role') ?></h4>
            </div>
        </div>
    </div>
    @if(Session::has('successt'))
    <input type="text" value="{{Session::get('successt')}}" id="rolet" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongThemR">Click
        me</button>
    @endif
    @if(Session::has('successX'))
    <input type="text" value="{{Session::get('successX')}}" id="roleX" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongXoaR">Click
        me</button>
    @endif
    @if(Session::has('successsua'))
    <input type="text" value="{{Session::get('successsua')}}" id="roleS" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongSuaR">Click
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
                            <th><?php echo __('role') ?></th>
                            <th style="width:10%;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td><input type="checkbox" id="checks" class="abc_Checkbox" name="check[]" value="{{$role->id}}"></td>
                            <td scope="row">{{ $key + 1 }}</td>
                            <td>{{ $role->name}}</td>
                            <td>
                                <a class="action-icon" data-iziModal-open="#modaleditrole{{$role->id}}"><i class="mdi mdi-square-edit-outline"></i></a>
                                <a class="action-icon" data-iziModal-open="#modaldeleterole{{$role->id}}"><i class="mdi mdi-delete"></i></a>

                                {{-- modal delete role  --}}
                                <div id="modaldeleterole{{$role->id}}" class="iziRole4" data-izimodal-loop="" data-izimodal-title="<?php echo __('Delete Role') ?>">
                                    <div class="p-2">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <strong>
                                                    <h5><?php echo __('Notification delete') ?></h3>
                                                </strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect waves-light" data-izimodal-close><?php echo __('Cancel') ?></button>
                                                <a href="{{ route('role.destroy', $role->id) }}" class="btn btn-danger"><?php echo __('Delete') ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal edit role  --}}
                                <div id="modaleditrole{{$role->id}}" class="iziRole1" data-izimodal-loop="" data-izimodal-title="<?php echo __('Edit Role') ?>">
                                    <div class="p-2">
                                        <form method="post" id="form_role_edit" action="{{ route('role.update', $role->id) }}">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="simpleinput"><?php echo __('role') ?></label>
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $role->name }}">
                                                @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label class="d-block" for=""><?php echo __('Choose permission') ?></label>
                                                <select class="selectpicker" data-live-search="true" multiple="" data-selected-text-format="count > 3" data-style="btn-light" name="permissions[]">
                                                    @foreach ($permissions as $permission)
                                                    <option {{ $role->hasPermissionTo($permission->name) ? 'selected' : '' }} value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-info waves-effect waves-light"><?php echo __('Btn_Edit') ?></button>
                                                <button type="button" class="btn btn-danger waves-effect waves-light" data-izimodal-close><?php echo __('Cancel') ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modaladdrole" class="iziRole2" data-izimodal-loop="" data-izimodal-title="<?php echo __('Add Role') ?>">
        <div class="p-2">
            <form method="post" id="form_role" action="{{ route('role.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="simpleinput"><?php echo __('role') ?></label>
                    <input type="text" name="name" id="simpleinput" class="form-control" value="{{ old('name')}}">

                </div>

                <div class="form-group">
                    <label for=""><?php echo __('Choose permission') ?></label>
                    <select class="selectpicker" data-live-search="true" multiple="" data-selected-text-format="count > 3" require data-style="btn-light" name="permissions[]">
                        @foreach ($permissions as $permission)

                        <option value="{{ $permission->id }}" @if($loop->first) selected @endif>{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info waves-effect waves-light"><?php echo __('Add Role') ?></button>
                    <button type="button" class="btn btn-danger waves-effect waves-light" data-izimodal-close><?php echo __('Cancel') ?></button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- End content -->
@endsection
@section('showJS')
<script src="backend\assets\js\role.js"></script>
<script src="backend\assets\js\HieuJS\alertUser.js"></script>
<script src="backend\assets\js\HieuJS\validateH.js"></script>
<script src="backend\assets\js\HieuJS\vaidateform.js"></script>
@endsection