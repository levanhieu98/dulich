//thông báo User
if ($('#user').val() == "Thêm quản trị viên thành công") {
    window.onload = function () {
        $("#ThanhCongUser").click();
    }
};
if ($('#userx').val() == "Xóa quản trị viên thành công") {
    window.onload = function () {
        $("#ThanhCongXoaUser").click();
    }
};
if ($('#users').val() == "Sửa quản trị viên thành công") {
    window.onload = function () {
        $("#ThanhCongSuaUser").click();
    }
};
if ($('#rolet').val() == "Thêm vai trò thành công") {
    window.onload = function () {
        $("#ThanhCongThemR").click();
    }
};
if ($('#roleX').val() == "Xóa vai trò thành công") {
    window.onload = function () {
        $("#ThanhCongXoaR").click();
    }
};
if ($('#roleS').val() == "Cập nhật vai trò thành công") {
  
    window.onload = function () {
        $("#ThanhCongSuaR").click();
       
    }
};

$("[id^='delete']").click(function(){
    if (!confirm("Bạn chắc chắn muốn xóa quản trị viên  này?")) {
        return false;
    }
});

$(document).ready(function(){
    $("#checkall").click(function () {
        if ($("#checkall").is(":checked")) {
            $("[id^='checks']").prop('checked', true);
            $("#click").css('display', 'block');
            $("#clicks").css('display', 'block');
    
        } else {
            $("[id^='checks']").prop('checked', false);
            $("#click").css('display', 'none');
            $("#clicks").css('display', 'none');
           
        }
    });
    
    $("[id^='checks']").click(function () {
        if ($("[id^='checks']").is(":checked")) {

            $("#click").css('display', 'block');
            $("#clicks").css('display', 'block');
        }
        else {
            $("#click").css('display', 'none');
            $("#clicks").css('display', 'none');
          
        }
    })
    
    
    $("#click").click(function () {
        var arr=[];
        if (!confirm("Bạn chắc chắn muốn xóa vao trò này?")) {
            return false;
        }
        $('.abc_Checkbox:checked').each(function () {
           arr.push($(this).val());
          
        });
        $.ajax({
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: "/user/delete",
            data: {
                id:arr,
            },
            success: function (data) {
                console.log(data);
                location.reload();
            }
        });    
    })
    
    $("#clicks").click(function () {
        var arr=[];
        if (!confirm("Bạn chắc chắn muốn xóa quản trị viên  này?")) {
            return false;
        }
        $('.abc_Checkbox:checked').each(function () {
           arr.push($(this).val());
          
        });
        $.ajax({
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: "/user/destroy-users",
            data: {
                id:arr,
            },
            success: function (data) {
                console.log(data);
                location.reload();
            }
        });
    })

    function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
              $('#blah').removeClass();
            $('#blah').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
      }
      $("#imgInp").change(function() {
        readURL(this);
      });
      function readURLs(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $("[id^='anh']").attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
      }
      $("[id^='IMG']").change(function() {
        readURLs(this);
      });
     

    //   function readURL(input) {
    //     if (input.files && input.files[0]) {
    //       var reader = new FileReader();
          
    //       reader.onload = function(e) {
    //           $('#blah').removeClass();
    //         $('#blah').attr('src', e.target.result);
    //       }
          
    //       reader.readAsDataURL(input.files[0]); // convert to base64 string
    //     }
    //   }
      
    //   $("#imgInp").change(function() {
    //     readURL(this);
    //   });

     
});
