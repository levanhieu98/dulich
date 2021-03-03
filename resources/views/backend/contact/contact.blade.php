@extends('backend.master.master2')
@section('title','Danh sách liên hệ')
@section('content')
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <button id="click" type="button" class="btn btn-info btn-sm " style="display:none"><?php echo __('Delete') ?></button>
                </div>
                <h4 class="page-title"><?php echo __('Contact list') ?></h4>
            </div>
        </div>
    </div>
    @if(Session::has('successx'))
    <input type="text" value="{{Session::get('successx')}}" id="contactx" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongXoaContact">Click
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
                            <th><?php echo __('Name') ?></th>
                            <th>Email</th>
                            <th><?php echo __('Subject') ?></th>
                            <th><?php echo __('Message') ?></th>
                            <th><?php echo __('Date') ?></th>
                            <th style="width: 10%"><?php echo __('Action') ?></th>
                        </tr>
                    </thead>

                    <tbody>
@foreach($data as $key=>$dt)
                        <tr>
                        <td><input type="checkbox" id="checks" class="abc_Checkbox" name="check[]" value="{{$dt->id}}"></td>
                            <td scope="row">{{$key+1}}</td>
                            <td>{{$dt->name}}</td>
                            <td>{{$dt->email}}</td>
                            <td>{{$dt->subject}}</td>
                            <td>{{$dt->message}}</td>   
                            <td>{{date('d-m-Y', strtotime($dt->created_at))}}</td>   
                            <td>
                                <a href="{{route('contact.destroy',$dt->id)}}" id="delete" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
@endsection
@section('showJS')

<script src="backend\assets\js\HieuJS\alertCategory.js"></script>
@endsection
