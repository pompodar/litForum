jQuery(document).ready(function () {
    // modal registering and login

    jQuery(".login-in-menu").on("click", function () {
        jQuery(".modal-login").removeClass("hide");
    });

    jQuery(".registration-menu").on("click", function () {
        jQuery(".modal-register").removeClass("hide");
    });

    jQuery(".close-button.modal").on("click", function () {
        jQuery(".modal-login").addClass("hide");
        jQuery(".modal-register").addClass("hide");
    });

    // typing

    setTimeout(() => {
        jQuery(".main-title a").addClass("no-border-right");
    }, 12000);

    // cover imge

    jQuery("#header-cover-image").attr("data-aos", "zoom-in");
    jQuery(".avatar-150.photo").attr("data-aos", "zoom-out");
});
