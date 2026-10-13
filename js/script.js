$(function () {
    "use strict";

    // Navbar scroll collapse
    $(window).on("scroll", function () {
        if ($(window).scrollTop() > 10) {
            $(".scrolling-navbar").addClass("top-nav-collapse");
        } else {
            $(".scrolling-navbar").removeClass("top-nav-collapse");
        }
    });

    // Banner carousel initialization
    if (typeof $.fn.owlCarousel === "function" && $(".banner-carousel").length) {
        $(".banner-carousel").owlCarousel({
            items: 4,
            loop: true,
            margin: 10,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            mouseDrag: true,
            animateOut: "fadeOut",
            responsive: {
                0: { items: 1 },
                600: { items: 1 },
                1000: { items: 1 }
            }
        });
    }

    // Client logo carousel initialization
    if (typeof $.fn.owlCarousel === "function" && $(".client-logo").length) {
        $(".client-logo").owlCarousel({
            items: 5,
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            mouseDrag: true,
            responsive: {
                0: { items: 2 },
                600: { items: 3 },
                1000: { items: 5 }
            }
        });
    }

    // Mobile navigation toggle
    $(".mobile_nav_icon").on("click", function (e) {
        if (e && typeof e.preventDefault === "function") {
            e.preventDefault();
        }
        $("body").toggleClass("current");
        $("#navbarResponsive2").toggleClass("menuopened");
        $(this).toggleClass("open");
    });

    // Mobile nav accordion dropdowns
    $(".mobile_nav li").on("click", function () {
        var $childUl = $(this).children("ul");
        $(".mobile_nav li > ul").not($childUl.toggle()).hide();
        $(".mobile_nav .nav-item").not($childUl.toggleClass("add")).removeClass("add");
    });

    $(".mobile_nav .nav-item").on("show.dropdown", function () {
        $(this).find(".dropdown-menu").first().stop(true, true).slideDown();
    });

    $(".mobile_nav .nav-item").on("hide.dropdown", function () {
        $(this).find(".dropdown-menu").first().stop(true, true).slideUp();
    });

    $(".dropdown-submenu a.link").on("click", function (e) {
        $(this).parent().find(".dropdown-menu").first().stop(true, true).slideToggle();
        $(this).toggleClass("open");
        e.stopPropagation();
        e.preventDefault();
    });

    // Load more gallery / card items
    if ($(".col-md-3").length) {
        $(".col-md-3").slice(0, 13).show();
        $("#loadMore").on("click", function (e) {
            e.preventDefault();
            $(".col-md-3:hidden").slice(0, 4).slideDown();
            if ($(".col-md-3:hidden").length === 0) {
                $("#loadMore").text("No Content").addClass("noContent");
            }
        });
    }

    // Datepicker initialization if plugin loaded
    if (typeof $.fn.datepicker === "function" && $(".datepicker").length) {
        $(".datepicker").datepicker({
            clearBtn: true,
            format: "dd/mm/yyyy"
        });
    }

    $("#reservationDate").on("change", function () {
        var val = $(this).find("input").val() || $("input").val() || "";
        $("#pickedDate").text(val);
    });

    // Modal video handler with safe origin validation
    var videoSrc = "";
    $(".video-btn").on("click", function () {
        var rawSrc = $(this).data("src");
        if (typeof rawSrc === "string" && rawSrc.length > 0) {
            try {
                var parsedUrl = new URL(rawSrc, window.location.href);
                if (parsedUrl.protocol === "https:" || parsedUrl.protocol === "http:" || rawSrc.charAt(0) === "/") {
                    videoSrc = rawSrc;
                }
            } catch (err) {
                videoSrc = "";
            }
        }
    });

    $("#myModal").on("shown.bs.modal", function () {
        if (videoSrc) {
            var delim = videoSrc.indexOf("?") !== -1 ? "&" : "?";
            $("#video").attr("src", videoSrc + delim + "autoplay=1&modestbranding=1&showinfo=0");
        }
    });

    $("#myModal").on("hide.bs.modal", function () {
        $("#video").attr("src", "");
    });

    // WOW animations initialization
    if (typeof WOW !== "undefined") {
        if (WOW.prototype && typeof WOW.prototype.addBox === "function") {
            WOW.prototype.addBox = function (box) {
                if (this.boxes) {
                    this.boxes.push(box);
                }
            };
        }
        new WOW().init();
    }
});