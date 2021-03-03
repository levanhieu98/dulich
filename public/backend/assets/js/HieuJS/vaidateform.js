
$(function () {
    $("#form-create-tour").validate({
        rules: {
            title: {
                required: true,
            },
            'avatar[]': {
                required: true,

            },
            price: {
                required: true,

            },
            location: {
                required: true,
            },
            place: {
                required: true,
            },
            date: {
                required: true,
            },
            image: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            'avatar[]': {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            location: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            place: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            date: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            image: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            price: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
        },
    });

});

$(function () {
    $("#form-edit-tour").validate({
        rules: {
            title: {
                required: true,
            },
            avatar: {
                required: true,

            },
           price: {
                required: true,

            },
            location: {
                required: true,
            },
            place: {
                required: true,
            },
            date: {
                required: true,
            },



        },
        messages: {
            title: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            avatar: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            location: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            place: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            date: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },

            price: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
        },
    });
});

$(function () {
    $("#form-create-blog").validate({
        rules: {
            title: {
                required: true,
            },
            category_id: {
                required: true,

            },
        },
        messages: {
            title: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            category_id: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
        },
    });
});

$(function () {
    $("#form-edit-blog").validate({
        rules: {
            title: {
                required: true,
            },
            category_id: {
                required: true,

            },
        },
        messages: {
            title: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            category_id: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
        },
    });
});

$(function () {
    $("#category_form").validate({
        rules: {
            name: {
                required: true,
            },
            slug: {
                required: true,

            },
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            slug: {
                 required: "<p style='color:red'>Trường này không được để trống</p>",

             },
        },
    });
});

$(function () {
    $("#category_form_edit").validate({
        rules: {
            name: {
                required: true,
            },
            slug: {
                required: true,

            },
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            slug: {
                 required: "<p style='color:red'>Trường này không được để trống</p>",

             },
        },
    });
});

$(function () {
    $("#form_role").validate({
        rules: {
            name: {
                required: true,
            },
            permissions: {
                required: true,

            },
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            permissions: {
                 required: "<p style='color:red'>Trường này không được để trống</p>",

             },
        },
    });
});

$(function () {
    $("#form_role_edit").validate({
        rules: {
            name: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
        },
    });
});

$(function () {
    $("#form-create-food").validate({
        rules: {
            name: {
                required: true,
                remote:{
                    url: "./checkfood",
                    type: "get",
            }
            },
            address: {
                required: true,
            },
            image: {
                required: true,
            },
            'avatar[]':{
                required: true,
            }
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            address: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            image: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            'avatar[]':{
                required: "<p style='color:red'>Trường này không được để trống</p>",
            }
            
        },
    });

});

$(function () {
    $("#form-create-restaurant").validate({
        rules: {
            name: {
                required: true,
                remote:{
                    url: "./checkrestaurant",
                    type: "get",
            }
            },
            address: {
                required: true,
            },
            time: {
                required: true,
            },
            time1: {
                required: true,
            },
            image: {
                required: true,
            },
            'avatar[]':{
                required: true,
            }
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            address: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            image: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            time: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            time1: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            'avatar[]': {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            
        },
    });

});

$(function () {
    $("#form-edit-restaurant").validate({
        rules: {
            name: {
                required: true,
            },
            address: {
                required: true,
            },
            time: {
                required: true,
            },
            time1: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            address: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            time: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            time1: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            
        },
    });
});

$(function () {
    $("#form-create-place").validate({
        rules: {
            name: {
                required: true,
                remote:{
                    url: "./checkplace",
                    type: "get",
            }
            },
            address: {
                required: true,
            },
            image: {
                required: true,
            },
            'avatar[]':{
                required: true,
            }
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            address: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            image: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            'avatar[]': {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
        },
    });

});

$(function () {
    $("#form-create-hotel").validate({
        rules: {
            name: {
                required: true,
                remote:{
                    url: "./checkhotel",
                    type: "get",
            }
            },
            address: {
                required: true,
            },
            image: {
                required: true,
            },
            'avatar[]':{
                required: true,
            }
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",     
            },
            address: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            image: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            'avatar[]': {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
           
            
        },
    });

});


$(function () {
    $("#hotel_update").validate({
        rules: {
            name: {
                required: true,
            },
            address: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            address: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            }
        },
    });

});

$(function () {
    $("#form-create-provice").validate({
        rules: {
            name: {
                required: true,
                remote:{
                    url: "./checkprovice",
                    type: "get",
            }
            },

            title: {
                required: true,
            },
            'avatar[]': {
                required: true,
            },
            price: {
                required: true,

            },
            location: {
                required: true,
            },
            place: {
                required: true,
            },
            date: {
                required: true,
            },
            image: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",     
            },
            title: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
            'avatar[]': {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            location: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            place: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            date: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            image: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            price: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
        },
    });

});

$(function () {
    $("#form-create-operators").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email:true,
            },
            address: {
                required: true,
            },
            phone: {
                required: true,
            },
            link: {
                required: true,
            },
            image: {
                required: true,
            },
            
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
           email: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
                email:"<p style='color:red'>Email không đúng định dạng</p>",

            },
            address: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            image: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            phone: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            link: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            address: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            phone: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
           
        },
    });

});

$(function () {
    $("#form-create-edit").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email:true,
            },
            address: {
                required: true,
            },
            phone: {
                required: true,
            },
            link: {
                required: true,
            },
           
            
        },
        messages: {
            name: {
                required: "<p style='color:red'>Trường này không được để trống</p>",

            },
           email: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
                email:"<p style='color:red'>Email không đúng định dạng</p>",

            },
            address: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            phone: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            link: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            address: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
            phone: {
                required: "<p style='color:red'>Trường này không được để trống</p>",
            },
           
        },
    });

});