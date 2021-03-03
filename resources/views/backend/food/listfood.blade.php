@extends('backend.master.master2')
@section('title','Danh sách món ăn')
@section('content')
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="form-inline">
                        <div class="form-group ml-1">
                            <button id="click" type="button" class="btn btn-info btn-sm " style="display:none"><?php echo __('Delete') ?></button>
                        </div>
                        <div class="input-group input-group-sm">
                            <select class="selectpicker show-tick" data-live-search="true" id="id_show_tick" data-style="btn-light">
                                <option value=" ">Chọn ngôn ngữ</option> 
                                @foreach( $language as $l )
                                @if($l->name == $tmp)
                                <option selected value="{{$l->id}}">{{$l->name}}</option>
                                @else
                                <option value="{{$l->id}}">{{$l->name}}</option>
                                @endif
                                @endforeach
                               

                            </select>
                        </div>
                        <a href="{{route('food.form')}}" class="btn btn-blue btn-sm ml-2">
                            <i class="mdi mdi-plus"></i><strong> <?php echo __('Add') ?></strong>
                        </a>
                    </form>
                </div>
                <h4 class="page-title"><?php echo __('Food list') ?></h4>
                <div class="col-2">
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('successx'))
    <input type="text" value="{{Session::get('successx')}}" id="foodx" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongXoaF">Click
        me</button>
    @endif
    @include('errors.error')
    @if(Session::has('Sua'))
    <input type="text" value="{{Session::get('Sua')}}" id="foods" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongSuaF">Click
        me</button>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <table id="scroll-horizontal-datatable" class="table table-striped  nowrap w-100">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkall"> <?php echo __('All') ?></th>
                            <th>Stt</th>
                            <th><?php echo __('Avatar') ?></th>
                            <th><?php echo __('Name') ?></th>
                            <th><?php echo __('Description') ?></th>
                            <th><?php echo __('address') ?></th>
                            <th style="width: 10%"><?php echo __('Action') ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($food as $key=>$fd)
                        <tr>
                            <td><input type="checkbox" id="checks" class="abc_Checkbox" name="check[]" value="{{$fd->id}}"></td>
                            <td scope="row">{{$key+1}}</td>
                            <td class="imgs"><img src="img/original/{{$fd->banner}}" alt=""></td>
                            <td>{{$fd->name}}</td>
                            <td>{!!$fd->description!!}</td>
                            <td>{{$fd->address}}</td>
                            <td>
                                <a href="{{route('food.show',$fd->slug)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <a href="{{route('food.destroy',$fd->id)}}" id="delete" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div> <!-- End content -->
@endsection
@section('showJS')
<script src="backend\assets\js\HieuJS\food.js"></script>
@endsection