@extends('backend.master.master2')
@section('content')
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="form-inline">
                    <button id="click" type="button" class="btn btn-info btn-sm " style="display:none"><?php echo __('Delete') ?></button>
                        <div class="form-group ml-1">
                            <div class="input-group input-group-sm">
                                <select class="selectpicker show-tick" id="id_show_laguage" data-style="btn-light">
                                <option value=""  >Ngôn ngữ</option>
                                    @foreach ($language as $item)
                                    @if($item->name == $tmp)
                                    <option selected value="{{$item->id}}">{{$item->name}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a href="{{route('touroperator.form')}}" class="btn btn-blue btn-sm ml-2">
                            <i class="mdi mdi-plus"></i><strong> <?php echo __('Add') ?></strong>
                        </a>
                    </form>
                </div>
                <h4 class="page-title"><?php echo __('Tours operators list') ?></h4>
                <div class="col-2">

                </div>
            </div>
        </div>
    </div>
    @if(Session::has('successx'))
    <input type="text" value="{{Session::get('successx')}}" id="x" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongXoaLH">Click
        me</button>
    @endif
    @include('errors.error')
    @if(Session::has('Sua'))
    <input type="text" value="{{Session::get('Sua')}}" id="S" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongSuaLH">Click
        me</button>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <table id="scroll-horizontal-datatable" class="table table-striped  nowrap w-100">
                    <thead>
                        <tr>
                        <th><input type="checkbox" id="checkall"> <?php echo __('All') ?></th>
                            <th><?php echo __('Avatar') ?></th>
                            <th><?php echo __('Name') ?></th>
                            <th><?php echo __('address') ?></th>
                            <th><?php echo __('Email') ?></th>
                            <th><?php echo __('phone') ?></th>
                            <th><?php echo __('Link') ?></th>
                            <th style="width: 10%"><?php echo __('Action') ?></th>
                        </tr>
                    </thead>

                    <tbody>
                      @foreach($traveler as $key=>$tr)
                        <tr>
                        <td>
                        <input type="checkbox" id="checks" class="abc_Checkbox" name="check[]" value="{{$tr->id}}"></td>
                            <td class="imgs"><img src="img/original/{{$tr->images}}" alt=""></td>
                            <td>{{$tr->name}}</td>
                            <td>{{$tr->address}}</td>
                            <td>{{$tr->email}}</td>
                            <td>{{$tr->phone}}</td>
                            <td><a href="{{$tr->links}}" target="_blank">{{$tr->links}}</a></td>
                            <td>
                                <a href="{{route('touroperator.show',$tr->id)}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                <a href="{{route('touroperator.destroy',$tr->id)}}" id="delete_" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
<script src="backend\assets\js\HieuJS\toursoperators.js"></script>
@endsection