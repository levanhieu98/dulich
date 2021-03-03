@extends('backend.master.master2')
@section('title','Danh sách khách hàng')
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
                <button id="click" type="button" class="btn btn-info btn-sm " style="display:none"><?php echo __('Delete') ?></button>
                </div>
                <h4 class="page-title"><?php echo __('Tourist') ?></h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <table id="scroll-horizontal-datatable" class="table table-striped  nowrap w-100">
                    <thead>
                        <tr>
                        <th><input type="checkbox" id="checkall"> <?php echo __('All') ?></th>
                            <th >STT</th>
                            <th><?php echo __('start date') ?></th>
                            <th><?php echo __('Time') ?></th>
                            <th><?php echo __('starting address') ?></th>
                            <th><?php echo __('adults') ?></th>
                            <th><?php echo __('children') ?></th>
                            <th><?php echo __('name') ?></th>
                            <th><?php echo __('phone') ?></th>
                            <th><?php echo __('address') ?></th>
                            <th>Email</th>
                            <th><?php echo __('Date') ?></th>
                            <th style="width: 10%"><?php echo __('Action') ?></th>
                            
                        </tr>
                    </thead>

                    <tbody>
                       @foreach ($tourist as $key => $item)
                       <tr>
                       <td><input type="checkbox" id="checks" class="abc_Checkbox" name="check[]" value="{{$item->id}}"></td>
                        <td>{{$key + 1}}</td>
                        <td>{{date('d-m-Y', strtotime($item->start_day))}}</td>
                        <td>{{$item->date_time}}</td>
                        <td>{{$item->start}}</td>
                        <td>{{$item->adults}}</td>
                        <td>{{$item->children}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                        <td>
                                <a href="{{route('deletekh',$item->id)}}" id="delete" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
<script>
 $("[id^='delete']").click(function () {
            if (!confirm("Bạn chắc chắn muốn xóa ?")) {
            return false;
        }
    })
 $("#checkall").click(function () {
            if ($("#checkall").is(":checked")) {
                $("[id^='checks']").prop('checked', true);
                $("#click").css('display', 'block');
               
    
            } else {
                $("[id^='checks']").prop('checked', false);
                $("#click").css('display', 'none');
             
            }
        });
    
        $("[id^='checks']").click(function () {
            if ($("[id^='checks']").is(":checked")) {
                $("#click").css('display', 'block');
              
            }
            else {
                $("#click").css('display', 'none');
              
            }
        })
    
        $("#click").click(function () {
            if (!confirm("Bạn chắc chắn muốn xóa ?")) {
            return false;
        }
            var arr=[];
            $('.abc_Checkbox:checked').each(function () {
               arr.push($(this).val());
              
            });
            $.ajax({
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "/delete-tourist",
                data: {
                    id:arr,
                },
                success: function (data) {
                    console.log(data);
                    location.reload();
                }
            });
        })

</script>
@endsection

