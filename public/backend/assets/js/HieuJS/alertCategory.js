if ($('#category').val() == "Thêm loại thành công") {
    window.onload = function () {
        $("#ThanhCongThem").click();
    }
};
if ($('#categoryx').val() == "Xóa loại thành công") {
    window.onload = function () {
        $("#ThanhCongXoa").click();
    }
};

if ($('#categorys').val() == "Sửa loại thành công") {
    window.onload = function () {
        $("#ThanhCongSua").click();
    }
};

if ($('#contactx').val() == "Xóa liên hệ thành công") {
    window.onload = function () {
        $("#ThanhCongXoaContact").click();
    }
   
};

$(document).ready(function () {

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
        if (!confirm("Bạn chắc chắn muốn xóa các liên hệ này?")) {
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
            url: "/contacts",
            data: {
                id:arr,
            },
            success: function (data) {
                console.log(data);
                location.reload();
            }
        });
    })
})

//category
$(document).ready(function () {

    $("#checkalls").click(function () {
        if ($("#checkalls").is(":checked")) {
            $("[id^='check']").prop('checked', true);
            $("#click").css('display', 'block');

        } else {
            $("[id^='check']").prop('checked', false);
            $("#click").css('display', 'none');
        }
    });

    $("[id^='check']").click(function () {
        if ($("[id^='check']").is(":checked")) {
            $("#clicks").css('display', 'block');
        }
        else {
            $("#clicks").css('display', 'none');
        }
    })

    $("#clicks").click(function () {
        if (!confirm("Bạn chắc chắn muốn xóa các thể loại này?")) {
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
            url: "/delete-category",
            data: {
                id:arr,
            },
            success: function (data) {
                console.log(data);
                location.reload();
            }
        });
    })
})