
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
$(function () {
    if ($('.addIziCategory').length) {
        $(".addIziCategory").iziModal({
            icon: "fas fa-user-tag",
            width: "46%",
            radius: 5,
            group: 2,
            headerColor: "#3f4144", //ヘッダー部分の色
            overlayColor: "rgba(0, 0, 0, 0.5)", //モーダルの背景色
            transitionIn: "fadeInUp", //表示される時のアニメーション
            transitionOut: "fadeOutDown", //非表示になる時のアニメーション
            loop: true,
        });
    }
})
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
jQuery(document).ready(function () {

    $("#id_show_tick").change(function () {
        $id_language = ($("#id_show_tick").val());
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: './blogs',
            data: {
                id: $id_language
            },
            success: function (data) {
                location.reload();
            }
        });
    });

    //thể loại và tag theo ngon ngữ 
    $id_languages = ($('#lang_chon').val());
    $('#lang_chon').change(function () {
        $id_languages = ($('#lang_chon').val());
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: './blogs/create',
            data: {
                id: $id_languages
            },
            success: function (data) {
                location.reload();
                //   console.log(data);
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
                    '<select class="show-tick form-control" id="add-parent" name="parent_id" data-style="btn-light" required>' +
                    '<option value="" selected></option>' +
                    str +
                    ' </select>'
                );
            }
        });
    });

    $("#btn-add-cate").click(function () {
        $("#error-category-add").text("");
        $("#div-error-tag-adda").css("display", "none");
        $("#error-slug-add").text("");
        $("#div-error-tag-addb").css("display", "none");
    })
    $("#btn-add-category").click(function (e) {
        e.preventDefault();
        $("#error-category-add").text("");
        $("#div-error-tag-adda").css("display", "none");
        $("#error-slug-add").text("");
        $("#div-error-tag-addb").css("display", "none");
        var name = $("#add-name").val();
        var slug = $("#add-slug").val();
        var language_id = $("#add-language").val();
        var parent_id = $("#add-parent").val();
        console.log(language_id, parent_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "./add-category-ajax",
            data: {
                name: name,
                slug: slug,
                parent_id: parent_id,
                language_id: language_id,
            },
            success: function (data) {
                console.log(data);
                ajaxShowDataCategory($("#lang_chon").val());
                $("#add-name").val("");
                $("#add-slug").val("");
                $("#add-language").val("");
                $("#add-parent").val("");
                $("#ThanhCongThem").click();
                $(".iziModal-button-close").click();

            },
            error: function (e) {
                console.log(e.responseJSON.errors.name[0]);
                $("#error-category-add").text(e.responseJSON.errors.name[0]);
                $("#div-error-tag-adda").css("display", "block");
                $("#error-slug-add").text(e.responseJSON.errors.slug[0]);
                $("#div-error-tag-addb").css("display", "block");
            }
        });
    });

    function ajaxShowDataCategory(id) {
        $.ajax({
            type: "GET",
            url: "./ajax-get-data-category",
            data: {
                id: id,
            },
            success: function (data) {
                console.log(data);
                var str = "";
                for (var i = 0; i < data['length']; i++) {
                    str += '<option value="' + data[i]["id"] + '">' + data[i]["name"] + '</option>'
                    $("#categoryFormCreateBlog").empty().append(
                        '<select class="form-control"  data-style="btn-light" name="category_id" >' +
                        str +
                        '</select>'
                    );
                }

            }
        });
    };

    $("#btn-add-taggg").click(function () {
        $("#error-tag-add").text("");
        $("#div-error-tag-add").css("display", "none");
        $("#error-tag-add1").text("");
        $("#div-error-tag-add1").css("display", "none");
    });
    $("#btn-submit-add-tag").click(function (e) {
        e.preventDefault();
        $("#error-tag-add").text("");
        $("#div-error-tag-add").css("display", "none");
        $("#error-tag-add1").text("");
        $("#div-error-tag-add1").css("display", "none");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "./add-tag",
            data: {
                name: $("#tag-add").val(),
                language_id: $("#languageid").val(),
                slug: $("#tag-slug").val(),
            },
            success: function (data) {
                console.log(data);
                location.reload();
            },
            error: function (e) {
                console.log(e);
                $("#error-tag-add").text(e.responseJSON.errors.name[0]);
                $("#div-error-tag-add").css("display", "block");
                $("#error-tag-add1").text(e.responseJSON.errors.slug[0]);
                $("#div-error-tag-add1").css("display", "block");
            }
        });
    });

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
        if (!confirm("Bạn chắc chắn muốn xóa các bài viết này?")) {
            return false;
        }
        var arr = [];
        $('.abc_Checkbox:checked').each(function () {
            arr.push($(this).val());

        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: "/delete-blog",
            data: {
                id: arr,
            },
            success: function (data) {
                console.log(data);
                location.reload();
            }
        });
    })

    $("#clicks").click(function () {
        if (!confirm("Bạn chắc chắn muốn xóa các bài viết này?")) {
            return false;
        }
        var arr = [];
        $('.abc_Checkbox:checked').each(function () {
            arr.push($(this).val());

        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: "/xoa-danh-sach-bai-viet-chua-duyet",
            data: {
                id: arr,
            },
            success: function (data) {
                console.log(data);
                location.reload();
            }
        });
    })
});


$("[id^='delete_blog']").click(function () {
    if (!confirm("Bạn chắc chắn muốn xóa bài viết này?")) {
        return false;
    }
});


if ($('#blog').val() == "Thêm bài viết thành công") {
    window.onload = function () {
        $("#ThanhCongThemB").click();
    }
};
if ($('#blogs').val() == "Sửa bài viết thành công") {
    window.onload = function () {
        $("#ThanhCongSuaB").click();
    }
};
if ($('#blogx').val() == "Xóa bài viết thành công") {
    window.onload = function () {
        $("#ThanhCongXoaB").click();
    }
};
if ($('#review').val() == "Thành công duyệt") {
    window.onload = function () {
        $("#ThanhCongDuyetB").click();
    }
};
//avatar
var loadFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        $("#image_blog").removeClass();
        var output = document.getElementById('image_blog');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};

$(document).ready(function () {
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
})

