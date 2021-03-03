$(function () {
    if ($('.izi-category').length) {
        $(".izi-category").iziModal({
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

//ngon ngu
$(document).ready(function () {
    $("#language_id").change(function () {
        $id_language = ($("#language_id").val());
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: './danh-sach-the-loai',
            data: {
                id: $id_language
            },
            success: function (data) {
                location.reload();
                console.log(data);
            }
        });
    });
    $("#add-language").change(function () {
        var id = this.value;

        $.ajax({
            type: "GET",
            url: "./get-data-category-by-language",
            data: {
                id: id,
            },
            success: function (data) {
                console.log(data);
                var str = "";
                for (var i = 0; i < data.length; i++) {
                    str += '<option value="' + data[i]["id"] + '">' + data[i]["name"] + '</option>'
                }
                $("#showSelectCategory").empty().append(
                    '<select class="show-tick form-control" id="add-parent" name="parent_id" data-style="btn-light">' +
                    '<option value="" selected></option>' +
                    str +
                    ' </select>'
                );
            }
        });
    });

    $("#edit-language").change(function () {
        var id = this.value;
        $.ajax({
            type: "GET",
            url: "./get-data-category-by-language",
            data: {
                id: id,
            },
            success: function (data) {
                console.log(data);
                var str = "";
                for (var i = 0; i < data.length; i++) {
                    str += '<option value="' + data[i]["id"] + '">' + data[i]["name"] + '</option>'
                }
                $("#showSelectCategory1").empty().append(
                    '<select class="show-tick form-control" id="eit-parent" name="parent_id" data-style="btn-light">' +
                    '<option value="" selected></option>' +
                    str +
                    ' </select>'
                );
            }
        });
    });
    $('[id^="btn-edit-form-category"]').click(function () {
        $id = $(this).data('idcategory');

        $("#id_category").val($id);
        $id_parent = $(this).data('idparent');
        $id_language = $(this).data('language');
        $("input[name=name]").val($("#view-name-category-" + $id).text());
        $("input[name=slug]").val($("#view-slug-category-" + $id).text());
        $("#edit-parent").val($id_parent);
        $("#edit-language").val($id_language);

    })

    $("[id^='btn-delete-category']").click(function () {
        if (!confirm("Bạn chắc chắn muốn xóa thể loại bài viết này?")) {
            return false;
        }
    });

    $('#add-name').change(function () {

        $.ajax({
            type: "GET",
            url: "./slug",
            data: {
                category: $('#add-name').val(),
            },
            success: function (data) {
                console.log(data);
                $('#add-slug').val(data);
            }
        });
    });

    $('#edit-name').change(function () {

        $.ajax({
            type: "GET",
            url: "./slug",
            data: {
                category: $('#edit-name').val(),
            },
            success: function (data) {
                console.log(data);
                $('#edit-slug').val(data);
            }
        });
    });
});

