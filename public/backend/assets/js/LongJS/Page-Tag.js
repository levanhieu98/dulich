$(function () {
    if ($('.izi-tag').length) {
        $(".izi-tag").iziModal({
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
jQuery(document).ready(function(){
    $('[id^="btn-edit-tag"]').click(function(){
        $('#language_id').val($(this).data('language'));
        $('#slug-edit').val($(this).data('slug'));
        $("#tag-edit").val($(this).data("tag"));
        $("#tag-id").val($(this).data("id"));
        $("#div-error-tag-edit").css("display","none");// Thẻ div bao error
        $("#error-tag-edit").text("");
    });

    $("#btn-submit-edit-tag").click(function(e){
        e.preventDefault();
        var name = $("#tag-edit").val();
            var id = $("#tag-id").val();
            var slug = $("#slug-edit").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "./edit-tag",
                data: {
                    id   : id,
                    name : name,
                    slug:slug,

                    language_id:$("#language_id").val(),
                },
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function (e) {      
                    $("#error-tag-edit").text(e.responseJSON.errors.name[0]);
                    $("#div-error-tag-edit").css("display","block");
                    $("#error-slug-edit").text(e.responseJSON.errors.slug[0]);
                    $("#div-error-slug-edit").css("display","block");
                }
            });
    });
    
    $("#btn-submit-add-tag").click(function(e){
        e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "./add-tag",
                data: {
                    name :$("#tag-add").val(),
                    language_id:$("#languageid").val(),
                    slug:$("#tag-slug").val(),
                },
                success: function (data) {
                    console.log(data);
                    location.reload();
                   
                },
                error: function (e) {
                    console.log(e);
                    $("#error-tag-add").text(e.responseJSON.errors.name[0]);
                    $("#div-error-tag-add").css("display","block");
                    $("#error-tag-add1").text(e.responseJSON.errors.slug[0]);
                    $("#div-error-tag-add1").css("display","block");
                }
            });
    });

    $('[id^="btn-delete-tag"]').click(function(){
        if (!confirm("Bạn chắc chắn muốn xóa tag này?")) {
            return false;
        }
        var id = $(this).data("id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "./delete-tag",
            data: {
                id : id,
            },
            success: function (data) {
                console.log(data);
                location.reload();
            },
        });
    });

    //ngon ngu
    $("#id_show_tag").change(function () {
        $id_language=($("#id_show_tag").val());
          $.ajax({
              type: 'GET',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: './danh-sach-tag',
              data: {
                  id:$id_language
              },
              success: function (data) {
                  location.reload();
                //   console.log(data);
              }
          });
      });
      
      $('#tag-add').change(function () {

        $.ajax({
            type: "GET",
            url: "./slug",
            data: {
                category: $('#tag-add').val(),
            },
            success: function (data) {
                console.log(data);
                $('#tag-slug').val(data);
            }
        });
    });

    $('#tag-edit').change(function () {

        $.ajax({
            type: "GET",
            url: "./slug",
            data: {
                category: $('#tag-edit').val(),
            },
            success: function (data) {
                console.log(data);
                $('#slug-edit').val(data);
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
        if (!confirm("Bạn chắc chắn muốn xóa các thẻ này?")) {
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
            url: "/deletes",
            data: {
                id:arr,
            },
            success: function (data) {
                console.log(data);
                location.reload();
            }
        });
    })
});
if ($('#tag').val() == "ok") {
    window.onload = function () {
        $("#ThanhCongThemT").click();
    }
};
if ($('#tags').val() == "ok") {
    window.onload = function () {
        $("#ThanhCongSuaT").click();
    }
};
if ($('#tagx').val() == "ok") {
    window.onload = function () {
        $("#ThanhCongXoaT").click();
    }
};