
$(document).ready(function () {

    $("#id_show_tick").change(function () {
        $id_language = ($("#id_show_tick").val());
        $.ajax({
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: './map',
            data: {
                id: $id_language
            },
            success: function (data) {
                location.reload();
            }
        });
    });

    $("[id^='deletes']").click(function () {
        let place_id = $(this).data("place");
        $.ajax({
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "./map-distrist",
            data: {
                id: place_id,
            },
            success: function (data) {
                $(`.place_${data}`).remove();
            },
            error: function (data) {
                console.log("loi");
            },
        });

    });
    $("form.add_place").submit(function (event) {
        event.preventDefault();
        let $this = $(this);
        let title = $this.find("input.form-control.title").val();
        let url = $this.find("input.form-control.url").val();
        let map_id = $this.find("input.form-control.map_id").val();
        let language_id = $this.find("input.form-control.language_id").val();
        let image = $this.find("input.form-control-file")[0].files[0];
        let data = new FormData();
        data.append("title", title);
        data.append("url", url);
        data.append("map_id", map_id);
        data.append("image", image);
        data.append("language_id", language_id);

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "./map-distrist-add",
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function (rp) {
                
                $(`.new_place_${map_id}`).append(
                    `<tr class="place_${rp.id}">
                        <td id="id${rp.id}" scope="row">${rp.id}</td>
                        <td id="title${rp.id}">${rp.title}</td>
                        <td id="images${rp.id}" class="imgs"><img src="img/original/${rp.image}" alt=""></td>
                        <td id="url${rp.id}">${rp.url}</td>
                        <td>
                            <a class="action-icon" onclick="sua(${rp.id},${rp.map_id},${rp.language_id})" id="edit_map" data-mapid="${rp.map_id}" data-lang="${rp.language_id}" name="${rp.id}" data-toggle="modal"
                            data-target="#modal-update-maps"> <i class="mdi mdi-square-edit-outline"></i></a>
                            <a style="cursor: pointer;" id="deletes" class="delete-place action-icon" onclick=(xoa(${rp.id})) data-place="${rp.id}" > <i class="mdi mdi-delete"></i></a>
                        </td>
                    </tr>
                    <script>
                    $('[id^="edit_map"]').on("click", function () {
                        $("#title").val($("#title" + this.name).text());
                        $("#id").val($("#id" + this.name).text());
                        $("#url").val($("#url" + this.name).text());
                        $("#language_id").val($(this).data('lang'));
                        $("#map_id").val($(this).data('mapid'));
                
                    });
                    </script>
                    `
                )
                $(`#modal-add-map-${map_id}`).modal('hide')
                $('.title').val("");
                $('.url').val("");
                $('#image').val("");

            },
            error: function (data) {
                console.log("loi");
            },
        });
    });

    if ($('#s').val() == "Sửa thành công") {
        window.onload = function () {
            $("#ThanhCongSuaBD").click();
        }
    };
   
    $('[id^="edit_map"]').on("click", function () {
        $("#title").val($("#title" + this.name).text());
        $("#id").val($("#id" + this.name).text());
        $("#url").val($("#url" + this.name).text());
        $("#language_id").val($(this).data('lang'));
        $("#map_id").val($(this).data('mapid'));

    });
    $(".update_place").submit(function (event) {
        event.preventDefault();
        let $this = $(this);
        let title = $this.find("input.form-control.title").val();
        let url = $this.find("input.form-control.url").val();
        let map_id = $this.find("input.form-control.map_id").val();
        let language_id = $this.find("input.form-control.language_id").val();
        let image = $this.find("input.form-control-file")[0].files[0];
        let id= $this.find("input.form-control.id").val();

        let data = new FormData();
        data.append("title", title);
        data.append("url", url);
        data.append("map_id", map_id);
        data.append("image", image);
        data.append("language_id", language_id);
        data.append("id",id);
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "./map-distrist-update",
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function (rp) {
                $('#id'+id).text(rp.id);
                $('#title'+id).text(rp.title);
                $('#url'+id).text(rp.url);
                $('#images'+id+" img" ).attr("src","img/original/"+rp.image)
                
                $('.close').click();
                // $('input').val("");
                console.log(rp);
            },
            error: function (data) {
                console.log("loi");
            },
        });
    });

});

function sua($id, $mapid, $lang) {
    $("#title").val($("#titel" + $id).text());
    $("#url").val($("#url" + $id).text());
    $("#language_id").val($mapid);
    $("#map_id").val($lang);
}

function xoa(id) {
    $.ajax({
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "./map-distrist",
        data: {
            id: id,
        },
        success: function (data) {
            console.log(data);
            $(`.place_${data}`).remove();
        },
        error: function (data) {
            console.log("loi");
        },
    });
}

