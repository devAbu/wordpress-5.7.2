"use strict";

(function ($) {

    $(window).on( "load", function() {
        image_carousel();
    });

    var image_carousel = function image_carousel() {
        var image_carousel_full = $("#image_carousel_full");
        var image_carousel_thumb = $("#image_carousel_thumb");
        var slidesPerPage = 12; //globaly define number of elements per page
        var syncedSecondary = false;

        image_carousel_full.owlCarousel({
            items: 1,
            margin: 0,
            slideSpeed: 300,
            nav: true,
            autoplay: false,
            dots: true,
            loop: true,
            animateIn: 'fadeIn',
            navText: ['<span class="property-icon-chevron-left-2"></span>', '<span class="property-icon-chevron-right-2"></span>'],
            responsive: {
                0: {
                    stagePadding: 0,
                },
                580: {
                    stagePadding: 100,
                },
                768: {
                    stagePadding: 150,
                },
                991: {
                    stagePadding: 200,
                },
                1024: {
                    stagePadding: 250,
                },
                1199: {
                    stagePadding: 300,
                },
                1440: {
                    stagePadding: 400,
                },
                1780: {
                    stagePadding: 470,
                }
            },
        }).on('changed.owl.carousel', syncPosition);

        image_carousel_thumb
            .on('initialized.owl.carousel', function() {
                image_carousel_thumb.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                dots: false,
                nav: false,
                loop: false,
                margin: 0,
                smartSpeed: 200,
                slideSpeed: 500,
                responsive: {
                    0: {
                        items: 3,
                    },
                    768: {
                        items: 6,
                    },
                    991: {
                        items: 8,
                    },
                    1024: {
                        items: slidesPerPage,
                    },
                },
            }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }

            //end block

            image_carousel_thumb
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = image_carousel_thumb.find('.owl-item.active').length - 1;
            var start = image_carousel_thumb.find('.owl-item.active').first().index();
            var end = image_carousel_thumb.find('.owl-item.active').last().index();

            if (current > end) {
                image_carousel_thumb.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                image_carousel_thumb.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                image_carousel_full.data('owl.carousel').to(number, 100, true);
            }
        }

        image_carousel_thumb.on("click", ".owl-item", function(e) {
            e.preventDefault();
            var number = $(this).index();
            image_carousel_full.data('owl.carousel').to(number, 300, true);
        });
    };

})(jQuery);