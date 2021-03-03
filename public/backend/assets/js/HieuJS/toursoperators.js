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

    $("#id_show_laguage").change(function () {
        $id_language = ($("#id_show_laguage").val());
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: './touroperator',
            data: {
                id: $id_language
            },
            success: function (data) {
                location.reload();
                console.log(data);
            }
        });
    });

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
            url: "./delete-touroperator",
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
//avatar
var loadFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        $("#output").removeClass();
        var output = document.getElementById('output');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};

$("[id^='delete_']").click(function () {
    if (!confirm("Bạn chắc chắn muốn xóa ?")) {
        return false;
    }
});

if ($('#luhanh').val() == "Thêm thành công") {
    window.onload = function () {
        $("#ThanhCongThemLH").click();
    }
};
if ($('#S').val() == "Sửa thành công") {
    window.onload = function () {
        $("#ThanhCongSuaLH").click();
    }
};
if ($('#x').val() == "Xóa thành công") {
    window.onload = function () {
        $("#ThanhCongXoaLH").click();
    }
};
