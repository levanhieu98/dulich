@extends('backend.master.master3')
@section('title','Trang chủ')
@section('content')
@section('showCSS')
    <link href="backend\assets\libs\quill\quill.core.css" rel="stylesheet" type="text/css">
    <link href="backend\assets\libs\quill\quill.snow.css" rel="stylesheet" type="text/css">
@endsection
<div class="content p-15">
    <!-- Start Content-->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right mr-4">
                    <a href="{{route('blog.review',$blog->id)}}" class="btn btn-success waves-effect waves-light"><?php echo __('Approved') ?></a>
                    <a href="./danh-sach-bai-viet-chua-duyet" class="btn btn-danger waves-effect waves-light ml-2"><?php echo __('Come back') ?></a>
                </div>
                <h4 class="page-title"><?php echo __('Detail Blog') ?></h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    {!!$blog->content!!}
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>

</div> <!-- content -->
<script>
    jQuery(document).ready(function(){
        $(".ql-editor").addClass("col-12");
        $(".ql-tooltip.ql-hidden").remove();
        $("img").attr("alt","image");
    });
</script>
@endsection
