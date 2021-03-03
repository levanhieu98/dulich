$(function () {
    $("#izi-js").remove();
    if ($('.iziRole1').length) {
        $(".iziRole1").iziModal({
            icon: "fas fa-edit",
            width: "40%",
            radius: 5,
            group: 'group1',
            headerColor: "#3f4144",
            overlayColor: "rgba(0, 0, 0, 0.5)",
            transitionIn: "fadeInUp",
            transitionOut: "fadeOutDown",
            loop: true
        });
    }
})
$(function () {
    if ($('.iziRole2').length) {
        $(".iziRole2").iziModal({
            icon: "fas fa-user-plus",
            width: "50%",
            height: "50%",
            radius: 5,
            group: 'group2',
            headerColor: "#3f4144",
            overlayColor: "rgba(0, 0, 0, 0.5)",
            transitionIn: "fadeInUp",
            transitionOut: "fadeOutDown",
            loop: true
        });
    }
})
$(function () {
    if ($('.iziRole4').length) {
        $(".iziRole4").iziModal({
            icon: "fas fa-trash-alt",
            width: "26%",
            radius: 5,
            // group: 'group4',
            headerColor: "#3f4144",
            overlayColor: "rgba(0, 0, 0, 0.5)",
            transitionIn: "fadeInUp",
            transitionOut: "fadeOutDown",
            loop: true
        });
    }
})
