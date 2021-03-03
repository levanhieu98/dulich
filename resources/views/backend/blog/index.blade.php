@extends('backend.master.master2')
@section('title','Danh sách blog')
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
                <div class="page-title-right">
                    <form class="form-inline">
                    <button id="click" type="button" class="btn btn-info btn-sm " style="display:none"><?php echo __('Delete') ?></button>
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
                        </div>
                        <a href="{{ route('blogs.create') }}" class="btn btn-blue btn-sm ml-2">
                            <i class="mdi mdi-plus"></i><strong> Thêm</strong>
                        </a>
                    </form>
                </div>
                <h4 class="page-title"><?php echo __('List Blog') ?></h4>
            </div>
        </div>
    </div>
    @if(Session::has('successS'))
                <input type="text" value="{{Session::get('successS')}}" id="blogs" class="d-none">
                <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongSuaB">Click
                    me</button>
    @endif
    @if(Session::has('successx'))
                <input type="text" value="{{Session::get('successx')}}" id="blogx" class="d-none">
                <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongXoaB">Click
                    me</button>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <table id="scroll-horizontal-datatable" class="table table-striped nowrap w-100">
                    <thead>
                        <tr>
                        <th><input type="checkbox" id="checkall"> <?php echo __('All') ?></th>
                            <th style="width:7%">Stt</th>
                            <th><?php echo __('Title') ?></th>
                            <th><?php echo __('Category') ?></th>
                            <th><?php echo __('Author') ?></th>
                            <!-- <th><?php echo __('Reviewer') ?></th> -->
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
                            <!-- <td>{{ $blog->publisher_id ? $blog->publisher->name : ''}}</td> -->
                            <td>
                                @if ($blog->publish_on == config('user.blog.pending.num') )

                                <a href="#" class="badge badge-warning p-1">{{ config('user.blog.pending.text') }}</a>
                                @else
                                <a href="#" class="badge badge-success p-1">{{ config('user.blog.publish.text') }}</a>
                                @endif
                            </td>
                            <td>{{ date('d-m-Y', strtotime($blog->created_at)) }}</td>
                            <td>
                                <a href="{{route('blog.from',$blog->id)}}" id="btn-edit" data-id="{{$blog->id}}" class="action-icon"> <i class="mdi mdi-square-edit-outline" title="Chỉnh sửa"></i></a>
                                <a href="{{route('blog.destroy',$blog->id)}}" id="delete_blog" class="action-icon"> <i class="mdi mdi-delete" title="Xóa"></i></a>
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