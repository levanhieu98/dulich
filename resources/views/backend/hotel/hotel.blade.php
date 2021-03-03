@extends('backend.master.master2')
@section('title','Danh sách khách sạn')
@section('content')
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="form-inline">
                        <div class="form-group ml-1">
                            <div class="input-group input-group-sm">
                                <select class="selectpicker show-tick" data-live-search="true" id="id_show_tick" data-style="btn-light">
                                    <option value=" " >Chọn ngôn ngữ</option>
                                    @foreach( $language as $l )
                                    @if($l->name == $tmp)
                                    <option selected value="{{$l->id}}">{{$l->name}}</option>
                                    @else
                                    <option value="{{$l->id}}">{{$l->name}}</option>
                                    @endif
                                    @endforeach

                                </select>
                            </div>
                            <button id="click" type="button" class="btn btn-info btn-sm " style="display:none"><?php echo __('Delete') ?></button>
                        </div>
                        <a href="{{route('hotel.form')}}" class="btn btn-blue btn-sm ml-2">
                            <i class="mdi mdi-plus"></i><strong> <?php echo __('Add') ?></strong>
                        </a>
                    </form>
                </div>
                <h4 class="page-title"><?php echo __('Hotel list') ?></h4>
                <div class="col-2">

                </div>
            </div>
        </div>
    </div>
    @if(Session::has('successx'))
    <input type="text" value="{{Session::get('successx')}}" id="kx" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongXoaK">Click
        me</button>
    @endif
    @include('errors.error')
    @if(Session::has('Sua'))
    <input type="text" value="{{Session::get('Sua')}}" id="ks" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongSuaK">Click
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
                        @foreach($hotel as $key=>$ht)
                        <tr>
                            <td><input type="checkbox" id="checks" class="abc_Checkbox" name="check[]" value="{{$ht->id}}"></td>
                            <td scope="row">{{$key+1}}</td>
                            <td class="imgs"><img src="./img/original/{{$ht->banner}}" alt=""></td>
                            <td>{{$ht->name}}</td>
                            <td>{!!$ht->description!!}</td>
                            <td>{{$ht->address}}</td>
                            <td>
                                <a href="{{route('hotel.show',$ht->slug)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <a href="{{route('hotel.destroy',$ht->id)}}" id="deletes" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
<script src="backend\assets\js\HieuJS\hotel.js"></script>
@endsection