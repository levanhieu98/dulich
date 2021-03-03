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
                        <a href="javascript: void(0);" class="btn btn-blue btn-sm ml-2"
                            data-iziModal-open="#modal-add-language" id="btn-form-add-language">
                            <i class="mdi mdi-plus"></i><strong> <?php echo __('Add') ?></strong>
                        </a>
                    </form>
                </div>
                <h4 class="page-title"><?php echo __('List Language') ?></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th style="width: 7%">#</th>
                            <th><?php echo __('Language') ?></th>
                            <th style="width:14%;"><?php echo __('Action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($language as $key => $item)
                        <tr>
                            <td>#{{$key + 1}}</td>
                            <td id="view-name-language-{{$item->id}}">{{$item->name}}</td>
                            <td>
                                <a id="btn-edit-form-language" href="javascript: void(0);" data-IdLanguage="{{$item->id}}" data-NameLanguage="{{$item->name}}" data-isoLanguage="{{$item->iso}}"
                                    data-iziModal-open="#modal-edit-language" title="<?php echo __('Edit') ?>" class="action-icon"> <i
                                        class="mdi mdi-square-edit-outline"></i></a>
                                <a id="btn-delete-form-language" href="javascript: void(0);" data-IdLanguage="{{$item->id}}" title="<?php echo __('Delete') ?>"  class="action-icon"> <i
                                        class="mdi mdi-delete"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modal-add-language" class="izi-add-language" data-izimodal-loop="" data-izimodal-title="<?php echo __('Add Language') ?>">
        <div class="">
            <form style="padding:2% 0 2% 0;margin:0 auto">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <!-- <div class="col-12">
                                <div class="col-7">
                                    <strong class="text-danger text-center" name="error" id="error-name-language" style="display: none"></strong>
                                </div>
                            </div> -->
                            <div class="d-flex mb-3 mt-2">
                                <div class="col-6 form-inline">
                                    <label class="col-form-label" for="name"><?php echo __('Language') ?>:</label>
                                    <div id="">
                                        <input type="text" id="name-language" name="name" required
                                            class="form-control ml-2 @error('name') is-invalid @enderror">
                                    </div>   
                                <div >
                                    <strong class="text-danger text-center" name="error" id="error-name-language" style="display: none"></strong>
                                </div>
                            
                                </div>
                                <div class="col-6 form-inline">
                                    <label class="col-form-label" for="name">ISO:</label>
                                    <div id="">
                                        <input type="text" id="iso-language"  name="iso" required
                                            class="form-control ml-2 @error('iso') is-invalid @enderror">
                                            <div >
                                    <strong class="text-danger text-center" name="error" id="iso-name-language" style="display: none"></strong>
                                </div>
                                    </div>                
                                </div>
                               
                            </div>
                             <div class=" text-right mr-3 ">
                                   
                                        <button id="btn-Add-Language" type="submit"
                                            class="btn btn-primary waves-effect waves-light mr-2"><i
                                                class="fas fa-plus"> </i> <?php echo __('Add') ?></button>
                                        <button type="button" class="btn btn-danger waves-effect waves-light"
                                            data-izimodal-close><?php echo __('cancel') ?></button>
                                    
                                </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </form>
        </div>
    </div>

    <div id="modal-edit-language" class="izi-edit-language" data-izimodal-loop="" data-izimodal-title="<?php echo __('Edit Language') ?>">
        <div class="">
            <form style="padding:2% 0 2% 0;margin:0 auto">
                <input type="hidden" id="id-language-edit">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-7">
                                <strong class="text-danger text-center" id="error-name-language-edit" style="display: none"></strong>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex mb-3 mt-2">
                                <div class="col-6 form-inline">
                                    <label class="col-form-label" for="name"><?php echo __('Language') ?>:</label>
                                    <div id="">
                                        <input type="text" id="name-language-edit"  name="name" required
                                            class="form-control ml-2">
                                    </div>
                                </div> 
                                <div class="col-6 form-inline">
                                    <label class="col-form-label" for="name">Iso:</label>
                                    <div id="">
                                        <input type="text" id="iso-language-edit"  name="iso" required
                                            class="form-control ml-2">
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="col text-right">
                                        <button id="btn-Edit-Language" type="submit"
                                            class="btn btn-primary waves-effect waves-light mr-2"><i
                                                class="fas fa-plus"> </i> <?php echo __('Update') ?></button>
                                        <button type="button" class="btn btn-danger waves-effect waves-light"
                                            data-izimodal-close><?php echo __('Cancel') ?></button>   
                        </div>
                    </div>
                </div> <!-- end col -->
            </form>
        </div>
    </div>

</div> <!-- End content -->
<button type="button" class="btn d-none" id="Thong-bao-edit-thanh-cong">Thong-bao-edit-thanh-cong</button>




@endsection

@section('showJS')
    <script src="backend\assets\js\LongJS\Page-Language.js"></script>
@endsection