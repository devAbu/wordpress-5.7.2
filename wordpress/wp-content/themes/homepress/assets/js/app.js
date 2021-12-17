"use strict";

(function ($) {
  $(document).ready(function () {
    homepress_admin_panel();
    homepress_select();
    homepress_sticky_header();
    homepress_nav_smooth_scroll();
    homepress_add_listing();
    stmt_property_menu();
    stm_nav_toggle();
    stm_share_url();
    back_to_results();
    stretch_columns();
    changed_recipient();
    inventory_mobile_filter_append(); // inventory_mobile_filter();

    property_phone_number();
    idx_modal_show();
    user_info_tabs();
  });
  $(window).on("load", function () {
    homepress_box_preloader();
    stm_compare();
    inventory_mobile_toggle();
    inventory_full_height();
    mobile_pagination();
    $('body').removeClass('enable_preloader');
  });
  $(window).on("scroll", function () {
    // inventory_mobile_filter();
    homepress_sticky_header();
  });
  $(window).on("resize", function () {
    stm_compare();
    stretch_columns();
    inventory_mobile_rm_classes(); // inventory_mobile_filter();

    inventory_full_height();
    mobile_pagination();
  });

  var idx_modal_show = function idx_modal_show() {
    $("[data-toggle=modal]").on('click', function () {
      var target = $(this).attr('data-target');
      setTimeout(function () {
        $(target).modal();
      }, 50);
    });
  };

  var homepress_admin_panel = function homepress_admin_panel() {
    $('body').each(function () {
      if ($(this).hasClass("admin-bar")) {
        $('html').addClass('homepress_admin_panel');
        var adminbar = $("#wpadminbar").outerHeight();

        if ($(window).scrollTop() >= adminbar) {
          $(".stm_nav_menu.active").parents(".header-box").css('margin-top', -adminbar);
        }
      }
    });
  };

  var inventory_mobile_filter_append = function inventory_mobile_filter_append() {
    if ($(window).width() < 1025) {
      $(".inventory-filter_box").appendTo(".header-box");
    } else {
      $(".inventory-filter_box").appendTo(".inventory-filter_box_wrap");
    }

    return false;
  };

  var inventory_mobile_filter = function inventory_mobile_filter() {
    if ($(window).width() < 1025) {
      var headerHeight = $(".header-box header").outerHeight();
      var filterrHeight = $(".inventory-filter_box").outerHeight();

      if ($(window).scrollTop() >= headerHeight) {
        $(".inventory-filter_box").parents(".header-box").css('padding-bottom', filterrHeight);
        $(".inventory-filter_box").addClass('sticky_filter');
      } else {
        $(".inventory-filter_box").parents(".header-box").css('padding-bottom', 0);
        $(".inventory-filter_box").removeClass('sticky_filter');
      }
    } else {
      $(".header-box").css('padding-bottom', 0);
      $("body").removeClass("open_filter");
    }

    return false;
  };

  var inventory_mobile_toggle = function inventory_mobile_toggle() {
    $(".stm_mobile_filter_switcher").on("click", function () {
      var filterrHeight = $(".inventory-filter_box").outerHeight();
      $(this).parents(".inventory-filter_box").toggleClass("open_filter");
      return false;
    });
  };

  var inventory_mobile_rm_classes = function inventory_mobile_rm_classes() {
    if ($(window).width() > 1025) {
      $(".inventory-filter_box").removeClass('filter_close');
      $(".mobile-filter-box").removeClass('preloader_show');
      $(".header-box").css('padding-bottom', 0);
      $("body").removeClass("open_filter");
    }
  };

  var homepress_sticky_header = function homepress_sticky_header() {
    $('.header-box, header > .elementor').each(function () {
      if ($(this).hasClass("header-position_fixed")) {
        if ($(window).scrollTop() >= 20) {
          $('.header-position_fixed').addClass('sticky_header');
        } else {
          $('.header-position_fixed').removeClass('sticky_header');
        }
      }
    });
  };

  var homepress_nav_smooth_scroll = function homepress_nav_smooth_scroll() {
    var headerHeight = $('.header-box').outerHeight();
    $('.nav_smooth_scroll a[href^="#"]').on('click', function (event) {
      var target = $(this.getAttribute('href'));

      if (target.length) {
        event.preventDefault();
        event.stopPropagation();
        $('html, body').stop().animate({
          scrollTop: target.offset().top - headerHeight
        }, 300);
      }
    });
  };

  var homepress_select = function homepress_select() {
    $("select").select2({
      placeholder: "Please select",
      minimumResultsForSearch: -1
    });
  };

  var homepress_box_preloader = function homepress_box_preloader() {
    $(".homepress_loading_preloader").removeClass('preloader_show');
    $(".homepress_sort_preloader").removeClass('preloader_show');
  };

  var inventory_full_height = function inventory_full_height() {
    var wW = $(window).width();

    if (wW > 991) {
      $('.scroll-panel-list').each(function () {
        if ($(this).hasClass("full-height")) {
          document.body.scrollTop = 0;
          document.documentElement.scrollTop = 0;
          $("body").addClass('inventory-full-height');
        }
      });
    } else {
      $("body").removeClass('inventory-full-height');
    }
  };

  var homepress_add_listing = function homepress_add_listing() {
    var wW = $(window).width();

    if (wW < 991) {
      $('.ulisting-approve-button').on('click', function () {
        $("html, body").animate({
          scrollTop: 0
        }, "slow");
      });
    }
  };

  var stmt_property_menu = function stmt_property_menu() {
    $(".stm_proterty_menu_more .proterty_menu_more").on('click', function () {
      $(this).parents(".stm_proterty_menu").addClass("show");
    });
    $(".stm_proterty_menu_more .proterty_menu_hide").on('click', function () {
      $(this).parents(".stm_proterty_menu").removeClass("show");
    });
  };

  var property_phone_number = function property_phone_number() {
    $('.property_show_phone').on('click', function () {
      $('.property_show_phone').find('span').hide();
      $('.property_show_phone').next('a').show();
    });
  };

  var stm_compare = function stm_compare() {
    $('.compare_right_columns .row').each(function () {
      var compare_right_columns = $(this).find('.compare_right_column').length;

      if (compare_right_columns < 4) {
        $(".compare_right_columns").addClass('three_columns');
      }
    });
    var heights = {};
    $('[data-index]').each(function (item_index, item) {
      var itemHeight = $(item).outerHeight();
      var index = $(item).data('index');
      if (typeof heights[index] === 'undefined' || heights[index] < itemHeight) heights[index] = itemHeight;
    });
    $.each(heights, function (item_index, height) {
      $("[data-index=\"".concat(item_index, "\"]")).css({
        minHeight: "".concat(height, "px")
      });
    });
  };

  var stm_share_url = function stm_share_url() {
    $('.stm_share .stm_js__shareble').on('click', function (e) {
      e.preventDefault();
      var url = $(this).data('share');
      var social = $(this).data('social') + '_share';
      window.open(url, social, 'width=580,height=296');
    });
  };

  var stretch_columns = function stretch_columns() {
    $('.elementor-element.stretch-to-left, .elementor-element.stretch-to-right').each(function () {
      var wW = $(window).width();
      var xPos = $(this).find('.elementor-element-populated').offset().left;
      var xW = $(this).find('.elementor-element-populated').width();
      var value = wW - (xW + xPos);

      if ($(this).hasClass('stretch-to-left')) {
        var stretch = 'left';
      }

      if ($(this).hasClass('stretch-to-right')) {
        var stretch = 'right';
      }

      if (stretch == 'left') {
        value = xPos;
      }

      $(this).find('.elementor-element-populated').css('width', xW + value + 'px');
      $(this).find('.elementor-element-populated').css('margin-' + stretch, '-' + value + 'px');
    });
  };

  var back_to_results = function back_to_results() {
    $('#homepress_back_to_results').on('click', function () {
      window.history.go(-1);
      return false;
    });
  };

  var stm_nav_toggle = function stm_nav_toggle() {
    $('.stm_mobile_switcher').on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).toggleClass('active');
      $(this).parent().toggleClass('active').find('.menu').toggleClass('active');
    });
    $('.stm_nav_menu_overlay').on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).parent().find('.stm_mobile_switcher').removeClass('active');
      $(this).parent().toggleClass('active').find('.menu').toggleClass('active');
    });
    $('.stm_mobile_switcher').toggle(function () {
      $(this).parents('.elementor-element').css('z-index', '100');
    }, function () {
      $(this).parents('.elementor-element').css('z-index', '10');
    });
    $('.stm_nav_menu .menu>li.menu-item-has-children').on('click', function (e) {
      var $this = $(this);

      if ($this.hasClass('active_sub_menu')) {
        $this.removeClass('active_sub_menu');
      } else {
        $('.stm_nav_menu .menu>li.menu-item-has-children').removeClass('active_sub_menu');
        $this.toggleClass('active_sub_menu');
        $this.parent().find('li .inner').slideUp(350);
      }
    });
  };

  var mobile_pagination = function mobile_pagination() {
    if ($(window).width() < 1024) {
      $(".stm-listing-pagination li").on('click', function () {
        var top = $("#stm-listing-list-panel").offset().top;
        $('body,html').animate({
          scrollTop: top - 80
        }, 100);
      });
    }
  };

  var changed_recipient = function changed_recipient() {
    var user_id = $('.users_recipient_form').attr('data-user_id');
    var inputAuthor = '<input type="hidden" class="user_recipient" name="homepress_changed_recipient" />';
    $('.users_recipient_form form').append(inputAuthor);
    $('.users_recipient_form .user_recipient').attr("value", user_id);
  };

  var user_info_tabs = function user_info_tabs() {
    $('.user_info_tabs .user_info_tab-1').on('click', function () {
      $(this).parents('.user_info_tabs').removeClass('user_info_tab-2 user_info_tab-3 user_info_tab-4').addClass('user_info_tab-1');
      createCookie('user_info_tab_active', 'user_info_tab-1', 7);
    });
    $('.user_info_tabs .user_info_tab-2').on('click', function () {
      $(this).parents('.user_info_tabs').removeClass('user_info_tab-1 user_info_tab-3 user_info_tab-4').addClass('user_info_tab-2');
      createCookie('user_info_tab_active', 'user_info_tab-2', 7);
    });
    $('.user_info_tabs .user_info_tab-3').on('click', function () {
      $(this).parents('.user_info_tabs').removeClass('user_info_tab-1 user_info_tab-2 user_info_tab-4').addClass('user_info_tab-3');
      createCookie('user_info_tab_active', 'user_info_tab-3', 7);
    });
    $('.user_info_tabs .user_info_tab-4').on('click', function () {
      $(this).parents('.user_info_tabs').removeClass('user_info_tab-1 user_info_tab-2 user_info_tab-3').addClass('user_info_tab-4');
      createCookie('user_info_tab_active', 'user_info_tab-4', 7);
    });
    $('.user_info_tabs').each(function () {
      if (!$(this).hasClass('user_info_tab-2') && !$(this).hasClass('user_info_tab-3') && !$(this).hasClass('user_info_tab-4')) {
        $('.user_info_tabs').addClass('user_info_tab-1');
      }
    });
  };
})(jQuery);

function stm_google_map_marker_infowindow(infowindow) {
  google.maps.event.addListener(infowindow, 'domready', function () {
    // Reference to the DIV that wraps the bottom of infowindow
    var iwOuter = jQuery('.gm-style-iw');
    var iwBackground = iwOuter.prev(); // Removes background shadow DIV

    iwBackground.children(':nth-child(2)').css({
      'display': 'none'
    }); // Removes white background DIV

    iwBackground.children(':nth-child(4)').css({
      'display': 'none'
    }); // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
    // iwCloseBtn.mouseout(function(){
    //     $(this).css({opacity: '1'});
    // });
  });
}

function createCookie(name, value, days) {
  var expires = "";
  var date = new Date();
  date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
  document.cookie = name + "=" + value + "; expires=" + date.toUTCString() + "; path=/";
}