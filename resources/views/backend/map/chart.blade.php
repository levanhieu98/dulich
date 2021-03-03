@extends('backend.master.master')
@section('title','Trang chủ')
@section('content')

<div style="height:400px;width:900px;margin:auto;">
    <canvas id="barChart">
    </canvas>
</div>
<script>
$(function () {
    var blogs=<?php echo json_encode($blog);?>;
    var tourist=<?php echo json_encode($tourist);?>;
    var contacts=<?php echo json_encode($contact);?>;
    var barCanvas=$("#barChart");
    var barChart=new Chart( barCanvas,{
        type:'bar',
        data:{
            labels:['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets:[
                
                {
                    label:'Blog',
                    data:blogs,
                    backgroundColor:['orange','orange','orange','orange','orange','orange','orange','orange','orange','orange','orange','orange'],

                },
                
                {
                    label:'Tourist',
                    data:tourist,
                    backgroundColor:['yellow','yellow','yellow','yellow','yellow','yellow','yellow','yellow','yellow','yellow','yellow','yellow'],

                },
                {
                    label:'Contact',
                    data:contacts,
                    backgroundColor:['violet','violet','violet','violet','violet','violet','violet','violet','violet','violet','violet','violet'],

                },


            ]
        },
        option:{
            scales:{
                yAxes:[{
                    ticks:{
                        beginAtZero:true
                    }
                }]
            }
        }
    });
   
})
</script>
@endsection
