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
                        <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-2" data-iziModal-open="#modaladdpermission">
                            <i class="mdi mdi-plus"></i><strong> Thêm</strong>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Danh sách quyền</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>quyền</th>
                            <th style="width:20%;">Thao tác</th>                                                   
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                         <tr>
                             <td scope="row">{{ $key + 1 }}</td>
                             <td>{{ $permission->name}}</td>
                             <td>
                                 <a class="btn btn-info text-white" data-iziModal-open="#modaleditpermission{{$permission->id}}"><i class="mdi mdi-square-edit-outline"></i></a>
                                 <a class="btn btn-danger text-white" data-iziModal-open="#modaldeletepermission{{$permission->id}}"><i class="mdi mdi-delete"></i></a>
                                 
                                 {{-- modal delete permission  --}}
                                 <div id="modaldeletepermission{{$permission->id}}" class="izi2" data-izimodal-loop="" data-izimodal-title="Xóa quyền">
                                    <div class="p-2">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa quyền này không?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect waves-light" data-izimodal-close>Hủy</button>
                                                <a href="{{ route('permission.destroy', $permission->id) }}" class="btn btn-danger">Xóa</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
     
                                 {{-- modal edit permission  --}}
                                 <div id="modaleditpermission{{$permission->id}}" class="izi2" data-izimodal-loop="" data-izimodal-title="Cập nhật quyền">
                                    <div class="p-2">
                                        <form method="post" action="{{ route('permission.update', $permission->id) }}">
                                            @csrf
                                                <div class="form-group mb-3">
                                                    <label for="simpleinput">Quyền</label>
                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $permission->name }}">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-izimodal-close>Hủy</button>
                                                    <button type="submit" class="btn btn-info">Cập nhật quyền</button>
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

    <div id="modaladdpermission" class="izi2" data-izimodal-loop="" data-izimodal-title="Thêm quyền">
        <div class="p-2">
            <form method="post" action="{{ route('permission.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="simpleinput">Quyền</label>
                    <input type="text" name="name" id="simpleinput" class="form-control @error('name') is-invalid @enderror" value="{{ old('name')}}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-izimodal-close>Hủy</button>
                    <button type="submit" class="btn btn-info">Thêm quyền</button>
                </div>
            </form>
        </div>
    </div>
    
</div> <!-- End content -->
@endsection
