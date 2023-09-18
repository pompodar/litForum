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

    // Check if the URL contains the specific string
    if (window.location.href.indexOf("#new-topic-0") > -1) {
        // Scroll down by 30 pixels
        jQuery("html, body").animate({ scrollTop: "1200px" }, 1000); // You can adjust the animation speed (e.g., 500 milliseconds)
    }

});
