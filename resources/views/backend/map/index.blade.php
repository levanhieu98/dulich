@extends('backend.master.master2')
@section('title','Quan li Ban do')
@section('content')
<style>
    .fa-times-circle {
        border-radius: 50%;
        -webkit-transition: -webkit-transform 0.5s cubic-bezier(.16, .81, .32, 1), opacity 0.5s ease-in-out;
        transition: 0.5s cubic-bezier(.16, .81, .32, 1), opacity 0.5s ease-in-out;
    }

    .fa-times-circle:hover {
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }
</style>
<div class="content p-15">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <div class="input-group input-group-sm">
                        <select class="selectpicker show-tick" data-live-search="true" id="id_show_tick" data-style="btn-light">
                            <option value=" ">Chọn ngôn ngữ</option>
                            @foreach( $languages as $l )
                            @if($l->name == $tmp)
                            <option selected value="{{$l->id}}">{{$l->name}}</option>
                            @else
                            <option value="{{$l->id}}">{{$l->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <h4 class="page-title"><?php echo __('Distrist list') ?></h4>
                <div class="col-2">
                </div>
            </div>
        </div>
    </div>
    @if(Session::has('successx'))
    <input type="text" value="{{Session::get('successx')}}" id="s" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongXoaBD">Click
        me</button>
    @endif
    @include('errors.error')
    @if(Session::has('Sua'))
    <input type="text" value="{{Session::get('Sua')}}" id="s" class="d-none">
    <button type="button" class="btn btn-success waves-effect waves-light btn-sm d-none" id="ThanhCongSuaBD">Click
        me</button>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <table id="scroll-horizontal-datatable" class="table table-striped nowrap w-100">
                    <thead>
                        <tr>
                            <th>Stt</th>
                            <th><?php echo __('Key') ?></th>
                            <th><?php echo __('Title') ?></th>
                            <th><?php echo __('Description') ?></th>
                            <th style="width: 10%"><?php echo __('Action') ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($map as $key=>$m)
                        <tr>
                            <td scope="row">{{$key+1}}</td>
                            <td>{{$m->key}}</td>
                            <td>{{$m->title}}</td>
                            <td>{!!$m->description!!}</td>
                            <td>
                                <a style="cursor: pointer;" id="suaMap" data-iziModal-open="#modal-update-map-{{$m->id}}" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                <!--modal -->
                @foreach($map as $key=>$m)
                <div id="modal-update-map-{{$m->id}}" class="izi7  row  " data-izimodal-loop="" data-izimodal-title="{{$m->key}}">
                    <div class="d-flex">
                        <div class="col-5 border-right">
                            <form action="./map/{{$m->id}}" id="{{$m->id}}"  method="post" style="padding:2% 0 2% 0;margin:0 auto">
                                @method('PUT')
                                @csrf
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label><?php echo __('Language') ?></label>
                                        <select class="selectpicker" data-live-search="true" data-selected-text-format="count > 3" data-style="btn-light" data-form="edit" id="lang_chon" name="language_id">
                                            @foreach ($languages as $language)
                                            <option value="{{ $language->id}}" {{$language->id==$m->language_id?'selected':""}}>{{ $language->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label><?php echo __('Title') ?></label>
                                        <input type="text" name="title" value="{{$m->title}}" class="form-control @error('title') is-invalid @enderror">
                                    </div>
                                    <div class="form-group">
                                        <label for="simpleinput"><?php echo __('Description') ?></label>
                                        <textarea name="description" class="form-control" rows='5'>{{$m-> description}}</textarea>
                                    </div>
                                    <div class="col text-center mb-2">
                                        <button type="submit" class="btn btn-success waves-light waves-effect"><?php echo __('Btn_Edit') ?></button>
                                    </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-7">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo __('Place') ?></a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th><?= __('Title') ?></th>
                                            <th><?= __('Image') ?></th>
                                            <th><?= __('Url') ?></th>
                                            <th><?= __('Action') ?></th>
                                            <th class="d-flex align-items-end flex-column">
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-map-{{$m->id}}">
                                                    <?= __('Add') ?>
                                                </button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="new_place_{{$m->id}}">
                                        @foreach($m->place as $place)
                                        <tr class="place_{{$place->id}}">
                                            <td id="id{{$place->id}}" scope="row">{{$place->id}}</td>
                                            <td id="title{{$place->id}}">{{$place->title}}</td>
                                            <td id="images{{$place->id}}" class="imgs"><img src="img/original/{{$place->image}}" alt=""></td>
                                            <td id="url{{$place->id}}">{{$place->url}}</td>
                                            <td>
                                                <a class="action-icon" id="edit_map" data-mapid="{{$place->map_id}}" data-lang="{{$place->language_id}}" name="{{$place->id}}" data-toggle="modal" data-target="#modal-update-maps"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                <a style="cursor: pointer;" id="deletes" class="delete-place action-icon" data-place="{{$place->id}}"> <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- End content -->
        <!--modal add -->
        <div class="modal fade" id="modal-add-map-{{$m->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document" style="left:25%;margin-right:55%;margin-top:10.5%;">
                <form class="add_place" id="add_place">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#3F3F44;padding: 10px 10px;">
                            <h5 class="modal-title" style="font-family: Arial, serif;color:white">
                                <?= __('Add') ?></h5>
                            <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times-circle" style="color:white"></i></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="map_id" value="{{$m->id}}" class="form-control map_id" hidden>
                            <input type="text" name="language_id" value="{{$m->language_id}}" class="form-control language_id" hidden>
                            <div class="form-group">
                                <label for=""> <?= __('Title') ?></label>
                                <input type="text" name="title" class="form-control title">
                            </div>
                            <div class="form-group">
                                <label for=""><?= __('Url') ?></label>
                                <input type="text" class="form-control url" name="url">
                            </div>
                            <div class="form-group">
                                <label for=""><?= __('Image') ?></label>
                                <input type="file" accept="image/*" class="form-control-file" id="image" name="image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <?= __('Close') ?></button>
                            <button type="submit" class="btn btn-primary"> <?= __('Add') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
        <!--modal update -->
        <div class="modal fade" id="modal-update-maps" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document" style="left:25%;margin-right:55%;margin-top:10.5%;">
                <form class="update_place">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#3F3F44;padding: 10px 10px;">
                            <h5 class="modal-title" style="font-family: Arial, serif;color:white">
                                <?= __('Update') ?></h5>
                            <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times-circle" style="color:white"></i></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="map_id" name="map_id" class="form-control map_id" hidden>
                            <input type="text" id="id" name="id" class="form-control id" hidden>
                            <input type="text" id="language_id" name="language_id" class="form-control language_id" hidden>
                            <div class="form-group">
                                <label for=""> <?= __('Title') ?></label>
                                <input type="text" id="title" name="title" class="form-control title">
                            </div>
                            <div class="form-group">
                                <label for=""><?= __('Url') ?></label>
                                <input type="text" class="form-control url" id="url" name="url">
                            </div>
                            <div class="form-group">
                                <label for=""><?= __('Image') ?></label>
                                <input type="file" accept="image/*" id="image" class="form-control-file" name="image">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <?= __('Close') ?></button>
                            <button type="submit" id="updates" class="btn btn-primary"> <?= __('Update') ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div> <!-- End content -->
@endsection
@section('showJS')
<script src="backend\assets\js\HieuJS\vaidateform.js"></script>
@endsection