@extends('backend.master.master2')
@section('title','Danh sách blog chưa duyệt')
@section('content')
<style>
    .card-box nav svg {
        width: 50px;
        height: 50px;
    }
</style>

<!-- Start Content-->
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right mr-4">
              
                    <form class="form-inline">
                    <button id="clicks" type="button" class="btn btn-info btn-sm " style="display:none"><?php echo __('Delete') ?></button>
                        <label for="id_show_tick" class="ml-1"><?php echo __('Language') ?>: </label>
                        <div class="form-group ml-1">
                            <div class="input-group input-group-sm border">

                                <select class="selectpicker show-tick" data-live-search="true" id="id_show_tick" data-style="btn-light">
                                    @foreach( $language as $l )
                                    @if($l->name == $tmp)
                                    <option selected value="{{$l->id}}">{{$l->name}}</option>
                                    @else
                                    <option value="{{$l->id}}">{{$l->name}}</option>
                                    @endif
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <h4 class="page-title"><?php echo __('List Unapproved Blog') ?></h4>
            </div>
        </div>
    </div>
    @if(Session::has('successD'))
                <input type="text" value="{{Session::get('successD')}}" id="review" class="d-none">
                <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongDuyetB">Click
                    me</button>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <table id="scroll-horizontal-datatable" class="table table-striped  nowrap w-100">
                    <thead>
                        <tr>
                        <th><input type="checkbox" id="checkall"> <?php echo __('All') ?></th>
                            <th style="width:7%">Stt</th>
                            <th><?php echo __('Title') ?></th>
                            <th><?php echo __('Category') ?></th>
                            <th><?php echo __('Author') ?></th>
                            <th><?php echo __('Reviewer') ?></th>
                            <th><?php echo __('Status') ?></th>
                            <th><?php echo __('Date Submitted') ?></th>
                            <th style="width:10%"><?php echo __('Action') ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($blogs as $key => $blog)
                        <tr>
                        <td><input type="checkbox" id="checks" class="abc_Checkbox" name="check[]" value="{{$blog->id}}"></td>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->category->name }}</td>
                            <td>{{ $blog->author->name }}</td>
                            <td>{{ $blog->publisher_id ? $blog->publisher->name : ''}}</td>
                            <td>
                                @if ($blog->publish_on == config('user.blog.pending.num') )

                                <a href="#" class="badge badge-warning p-1">{{ config('user.blog.pending.text') }}</a>
                                @else
                                <a href="#" class="badge badge-success p-1">{{ config('user.blog.publish.text') }}</a>
                                @endif
                            </td>
                            <td>{{ date('d-m-Y', strtotime($blog->created_at)) }}</td>
                            <td>
                                <a href="./detail-blog-chua-duyet/{{$blog->id}}}" class="action-icon"> <i class="mdi mdi-file-eye-outline"></i></a>
                                <a href="{{route('blog.destroy',$blog->id)}}" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
<script src="backend\assets\js\LongJS\Page-Blog.js"></script>
@endsection