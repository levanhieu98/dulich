!(function (p) {
    "use strict";
    function t() { }
    (t.prototype.send = function (t, i, o, e, n, a, s, r) {
        var c = {
            heading: t,
            text: i,
            position: o,
            loaderBg: e,
            icon: n,
            hideAfter: (a = a || 3e3),
            stack: (s = s || 1)
        };
        r && (c.showHideTransition = r),
            console.log(c),
            p.toast().reset("all"),
            p.toast(c);
    }),
        (p.NotificationApp = new t()),
        (p.NotificationApp.Constructor = t);
})(window.jQuery),
    (function (i) {
        "use strict";
        i("#toastr-one").on("click", function (t) {
            i.NotificationApp.send(
                "Heads up!",
                "This alert needs your attention, but it is not super important.",
                "top-right",
                "#3b98b5",
                "info"
            );
        }),
            i("#toastr-two").on("click", function (t) {
                i.NotificationApp.send(
                    "Heads up!",
                    "Check below fields please.",
                    "top-center",
                    "#da8609",
                    "warning"
                );
            }),
            i("#toastr-three").on("click", function (t) {
                i.NotificationApp.send(
                    "Well Done!",
                    "You successfully read this important alert message",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongUser").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Thêm thành công quản trị viên",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongXoaUser").on("click", function (t) {
                i.NotificationApp.send(
                    "Cảnh báo!",
                    "Xóa quản trị viên thành công.",
                    "top-right",
                    "#bf441d",
                    "error"
                );
            }),
            i("#ThanhCongSuaUser").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Sửa thành công quản trị viên",
                    "top-right",
                    // "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongThem").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Thêm thành công thể loại",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongXoa").on("click", function (t) {
                i.NotificationApp.send(
                    "Cảnh báo!",
                    "Xóa thể loại thành công.",
                    "top-right",
                    "#bf441d",
                    "error"
                );
            }),
            i("#ThanhCongSua").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Sửa thành công thể loại",
                    "top-right",
                    // "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongThemB").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Thêm thành công bài viết",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongDuyetB").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Duyệt thành công bài viết",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongSuaB").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Sửa thành công bài viết",
                    "top-right",
                    // "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongXoaB").on("click", function (t) {
                i.NotificationApp.send(
                    "Cảnh báo!",
                    "Xóa bài viết thành công.",
                    "top-right",
                    "#bf441d",
                    "error"
                );
            }),
            i("#ThanhCongThemR").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Thêm thành công vai trò",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongXoaR").on("click", function (t) {
                i.NotificationApp.send(
                    "Cảnh báo!",
                    "Xóa vai trò thành công.",
                    "top-right",
                    "#bf441d",
                    "error"
                );
            }),
            i("#ThanhCongSuaR").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Sửa thành công bài viết",
                    "top-right",
                    // "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongThemT").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Thêm thành công thẻ",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongThemST").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Sửa thành công",
                    "top-right",
                    // "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongXoaT").on("click", function (t) {
                i.NotificationApp.send(
                    "Cảnh báo!",
                    "Xóa thẻ thành công.",
                    "top-right",
                    "#bf441d",
                    "error"
                );
            }),
            i("#ThanhCongSuaT").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Sửa thành công thẻ",
                    "top-right",
                    // "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongThemT").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Thêm thành công ",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongXoaTour").on("click", function (t) {
                i.NotificationApp.send(
                    "Cảnh báo!",
                    "Xóa  thành công.",
                    "top-right",
                    "#bf441d",
                    "error"
                );
            }),
            i("#ThanhCongXoaContact").on("click", function (t) {
                i.NotificationApp.send(
                    "Cảnh báo!",
                    "Xóa liên hệ thành công.",
                    "top-right",
                    "#bf441d",
                    "error"
                );
            }),
            i("#ThanhCongThemR").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Thêm thành công ",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongXoaR").on("click", function (t) {
                i.NotificationApp.send(
                    "Cảnh báo!",
                    "Xóa thành công.",
                    "top-right",
                    "#bf441d",
                    "error"
                );
            }),
            i("#ThanhCongSuaR").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Sửa thành công",
                    "top-right",
                    // "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongThemF").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Thêm thành công ",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongSuaF").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Sửa thành công",
                    "top-right",
                    // "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongXoaF").on("click", function (t) {
                i.NotificationApp.send(
                    "Cảnh báo!",
                    "Xóa thành công.",
                    "top-right",
                    "#bf441d",
                    "error"
                );
            }),
            i("#ThanhCongSuaK").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Sửa thành công",
                    "top-right",
                    // "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongXoaK").on("click", function (t) {
                i.NotificationApp.send(
                    "Cảnh báo!",
                    "Xóa thành công.",
                    "top-right",
                    "#bf441d",
                    "error"
                );
            }),

            i("#ThanhCongThemLH").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Thêm thành công lữ hành",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongSuaLH").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Sửa thành công lữ hành",
                    "top-right",
                    // "#5ba035",
                    "success"
                );
            }),
            i("#ThanhCongXoaLH").on("click", function (t) {
                i.NotificationApp.send(
                    "Cảnh báo!",
                    "Xóa thành công lữ hành.",
                    "top-right",
                    "#bf441d",
                    "error"
                );
            }),
            i("#ThanhCongSuaBD").on("click", function (t) {
                i.NotificationApp.send(
                    "Chúc mừng!",
                    "Sửa thành công ",
                    "top-right",
                    // "#5ba035",
                    "success"
                );
            }),
            i("#toastr-five").on("click", function (t) {
                i.NotificationApp.send(
                    "How to contribute?",
                    [
                        "Fork the repository",
                        "Improve/extend the functionality",
                        "Create a pull request"
                    ],
                    "top-right",
                    "#1ea69a",
                    "info"
                );
            }),


            i("#toastr-six").on("click", function (t) {
                i.NotificationApp.send(
                    "Can I add <em>icons</em>?",
                    "Yes! check this <a href='https://github.com/kamranahmedse/jquery-toast-plugin/commits/master'>update</a>.",
                    "top-right",
                    "#1ea69a",
                    "info",
                    !1
                );
            }),
            i("#toastr-seven").on("click", function (t) {
                i.NotificationApp.send(
                    "",
                    "Set the `hideAfter` property to false and the toast will become sticky.",
                    "top-right",
                    "#1ea69a",
                    ""
                );
            }),
            i("#toastr-eight").on("click", function (t) {
                i.NotificationApp.send(
                    "",
                    "Set the `showHideTransition` property to fade|plain|slide to achieve different transitions.",
                    "top-right",
                    "#1ea69a",
                    "info",
                    3e3,
                    1,
                    "fade"
                );
            }),
            i("#toastr-nine").on("click", function (t) {
                i.NotificationApp.send(
                    "Slide transition",
                    "Set the `showHideTransition` property to fade|plain|slide to achieve different transitions.",
                    "top-right",
                    "#1ea69a",
                    "info",
                    3e3,
                    1,
                    "slide"
                );
            }),
            i("#toastr-ten").on("click", function (t) {
                i.NotificationApp.send(
                    "Plain transition",
                    "Set the `showHideTransition` property to fade|plain|slide to achieve different transitions.",
                    "top-right",
                    "#3b98b5",
                    "info",
                    3e3,
                    1,
                    "plain"
                );
            }),
            i("#Thong-bao-edit-thanh-cong").on("click", function (t) {
                i.NotificationApp.send(
                    "Thành công!",
                    "Bạn đã chỉnh sửa thành công",
                    "top-right",
                    "#5ba035",
                    "success"
                );
            });
    })(window.jQuery);
