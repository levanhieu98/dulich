$(function () {
    if ($('.izi-edit-language').length) {
        $(".izi-edit-language").iziModal({
            icon: "fas fa-user-tag",
            width: "46%",
            radius: 5,
            headerColor: "#3f4144", //ヘッダー部分の色
            overlayColor: "rgba(0, 0, 0, 0.5)", //モーダルの背景色
            transitionIn: "fadeInUp", //表示される時のアニメーション
            transitionOut: "fadeOutDown", //非表示になる時のアニメーション
            loop: true,
        });
    }
})

$(function () {
    if ($('.izi-add-language').length) {
        $(".izi-add-language").iziModal({
            icon: "fas fa-user-tag",
            width: "46%",
            radius: 5,
            group: 'group',
            headerColor: "#3f4144", //ヘッダー部分の色
            overlayColor: "rgba(0, 0, 0, 0.5)", //モーダルの背景色
            transitionIn: "fadeInUp", //表示される時のアニメーション
            transitionOut: "fadeOutDown", //非表示になる時のアニメーション
            loop: true,
        });
    }
})

jQuery(document).ready(function(){

    

    //Nút mở form thêm ngôn ngữ
    $("#btn-form-add-language").click(function(){
        $("#error-name-language").css("display","none");
        $("#error-name-language").text("");
        $("#name-language").val("");
    });

    //Xử lý sự kiện nút thêm ngôn ngữ
    $("#btn-Add-Language").click(function(e){
        e.preventDefault();
        var name = $("#name-language").val();
        var iso = $("#iso-language").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "./add-language",
                data:{
                    name: name,
                    iso:iso,
                },
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (e) {
                    console.log(e.responseJSON.errors);
                    $("#error-name-language").css("display","block");
                    $("#error-name-language").text(e.responseJSON.errors.name[0]);
                    $("#iso-name-language").css("display","block");
                    $("#iso-name-language").text(e.responseJSON.errors.iso[0]);
                }
            });
    });

    //Nút mở form chỉnh sửa ngôn ngữ
    $('[id^="btn-edit-form-language"]').click(function (e) { 
      
        $("#iso-language-edit").val($(this).data("isolanguage"));
        $("#name-language-edit").val($(this).data("namelanguage"));
        $("#id-language-edit").val($(this).data("idlanguage"));
    });

    //Xử lý sự kiện nút chỉnh sửa ngôn ngữ
    $("#btn-Edit-Language").click(function(e){
        e.preventDefault();
        var name = $("#name-language-edit").val();
        var iso = $("#iso-language-edit").val();
        if(name){
            var id = $("#id-language-edit").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "./edit-language",
                data:{
                    name: name,
                    id  : id,
                    iso:iso
                },
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (e) {
                    console.log(e.responseJSON.errors.name[0]);
                    $("#error-name-language-edit").css("display","block");
                    $("#error-name-language-edit").text(e.responseJSON.errors.name[0]);
                }
            });
        }
    });

    //Xử lý sự kiện nút xóa ngôn ngữ
    $('[id^="btn-delete-form-language"]').click(function (e) { 
        if (!confirm("Bạn chắc chắn muốn xóa ngôn ngữ này?")) {
            return false;
        }
        var id = $(this).data("idlanguage");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "./delete-language",
            data:{
                id : id,
            },
            success: function (data) {
                console.log(data);
                location.reload();
            },
        });
    });
});
