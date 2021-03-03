$(document).ready(function () {

    $("#id_show_tick").change(function () {
        $id_language = ($("#id_show_tick").val());
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: './place',
            data: {
                id: $id_language
            },
            success: function (data) {
                location.reload();
            }
        });
    });

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
        if (!confirm("Bạn chắc chắn muốn xóa các địa điểm  này?")) {
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
            url: "/delete-place",
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
 var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function() {
        $("#output").removeClass();
        var output = document.getElementById('output');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};
//Ablum
function previewImages() {
    var $preview = $('#preview').empty();
    if (this.files) $.each(this.files, readAndPreview);

    function readAndPreview(i, file) {
        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
            document.getElementById("file-input").value = '';
            return alert(file.name + " File không hợp lệ ");
        }
        var reader = new FileReader();
        $(reader).on("load", function() {
            $preview.append($("<img/>", {
                src: this.result,
                height: 100
            }));
        });
        reader.readAsDataURL(file);
    }
}
$('#file-input').on("change", previewImages);

if ($('#res').val() == "Thêm thành công") {
    window.onload = function() {
        $("#ThanhCongThemR").click();
    }
};

if ($('#ks').val() == "Sửa thành công") {
    window.onload = function() {
        $("#ThanhCongSuaK").click();
    }
};

if ($('#kx').val() == "Xóa thành công") {
    window.onload = function() {
        $("#ThanhCongXoaK").click();
    }
};

$("[id^='deletess']").click(function () {
    if (!confirm("Bạn chắc chắn muốn xóa địa điểm này?")) {
        return false;
    }
});

