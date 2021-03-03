@extends('backend.master.master')
@section('title','Trang chủ')
@section('content')

<div class="content p-15">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                </div>
                <h4 class="page-title"><?php echo __('THANH HOA TOURIST ASSOCIATION') ?></h4>
            </div>
        </div>
    </div>

        <div class="row ">
            <div class="col-6 col-xl-4 col-lg-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6  col-lg-3">
                            <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                                <a href="{{route('review')}}"><i class="fe-eye font-22 avatar-title text-warning"></i></a>
                            </div>
                        </div>
                        <div class="col-6  col-lg-9">
                            <div class="text-right">
                                <h5 class="text-dark mt-1"><span> <?php echo __('Unapproved post') ?></span></h5>
                                <h4 class="mb-1  text-truncate" id="review">{{$blog_review}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-4 col-lg-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                                <a href="./blogs"><i class="fas fa-pen-fancy font-22 avatar-title text-primary"></i></a>
                            </div>
                        </div>
                        <div class="col-6 col-lg-9">
                            <div class="text-right">
                                <h5 class="mt-1 "><span><?php echo __('Total number of posts') ?></span></h5>
                                <h4 class=" mb-1  text-truncate" id="blog">{{$blog_today}} </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-4 col-lg-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                                <a href="{{route('contact.index')}}"><i class="fas fa-envelope-open-text font-22 avatar-title text-success"></i></a>
                            </div>
                        </div>
                        <div class="col-6 col-lg-9">
                            <div class="text-right">
                                <h5 class="text-dark mt-1"><span><?php echo __('Total contact') ?></span></h5>
                                <h4 class=" mb-1 text-truncate" id="contact">{{$contact}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-4 col-lg-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                                <a href="{{route('hotel.index')}}"> <i class="fas fa-hotel font-22 avatar-title text-info"></i></a>
                            </div>
                        </div>
                        <div class="col-6 col-lg-9">
                            <div class="text-right">
                                <h5 class="text-dark mt-1"><span><?php echo __('Total hotel') ?></span></h5>
                                <h4 class=" mb-1  text-truncate" id="hotel">{{$hotel}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-6 col-xl-4 col-lg-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="avatar-lg rounded-circle bg-soft-inf border-info border">
                                <a href="{{route('tourist.index')}}"> <i class="fas fa-user-tie font-22 avatar-title text-info"></i></a>
                            </div>
                        </div>
                        <div class="col-6 col-lg-9">
                            <div class="text-right">
                                <h5 class="text-dark mt-1 "><span><?php echo __('Travel contact') ?></span></h5>
                                <h4 class="mb-1  text-truncate" id="tour">{{$tourist}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-4 col-lg-4">
                <div class="widget-rounded-circle card-box">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="avatar-lg rounded-circle bg-soft-in border-info border">
                                <a href="{{route('restaurant.index')}}"> <i class="fas fa-igloo font-22 avatar-title text-info"></i></a>
                            </div>
                        </div>
                        <div class="col-6 col-lg-9">
                            <div class="text-right">
                                <h5 class="text-dark mt-1"><span><?php echo __('Total restaurant') ?></span></h5>
                                <h4 class=" mb-1 text-truncate" id="restaurant">{{$restaurant}}</h4>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
       
    <script>
    $(document).ready(function(){
      refreshTable();
    });
    function refreshTable(){
    $.ajax({
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "/load",
                success: function (data) {
                    // console.log(data);
                   $('#restaurant').text(data.restaurant);
                   $('#review').text(data.blog_review);
                   $('#blog').text(data.blog_today);
                   $('#contact').text(data.contact);
                   $('#hotel').text(data.hotel);
                   $('#tour').text(data.tourist);
                }
            });
           setTimeout(refreshTable, 2000);
        
    }
</script>
    @endsection
@section('showJS')
@endsection