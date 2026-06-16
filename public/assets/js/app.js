var THEMEIM = THEMEIM || {};

(function($) {




  // USE STRICT
  "use strict";

  THEMEIM.initialize = {

    init: function() {
      THEMEIM.initialize.general();
      THEMEIM.initialize.mobileMenu();
    },



    general: function() {

      /* Main Slider  */
      $('.slider-start').owlCarousel({
        loop: true,
        nav: false,
        items: 1,
        autoplay: false,
        dots: true,
        smartSpeed: 600

      });

      $(".slider-start").on('translate.owl.carousel', function() {
        $('.slider-img').removeClass('fadeInDown animated').hide();
      });

      $(".slider-start").on('translated.owl.carousel', function() {
        $('.slider-img').addClass('fadeInDown animated').show();
      });


      $(".slider-start").on('translate.owl.carousel', function() {
        $('.slider-text h4').removeClass('fadeInUp animated').hide();
      });

      $(".slider-start").on('translated.owl.carousel', function() {
        $('.slider-text h4').addClass('fadeInUp animated').show();
      });

      $(".slider-start").on('translate.owl.carousel', function() {
        $('.slider-text h1').removeClass('fadeInUp animated').hide();
      });

      $(".slider-start").on('translated.owl.carousel', function() {
        $('.slider-text h1').addClass('fadeInUp animated').show();
      });


      $(".slider-start").on('translated.owl.carousel', function() {
        $('.slider-text p').addClass('fadeInUp animated').show();
      });

      $(".slider-start").on('translate.owl.carousel', function() {
        $('.slider-text p').removeClass('fadeInUp animated').hide();
      });

      $(".slider-start").on('translated.owl.carousel', function() {
        $('.slider-text a').addClass('fadeInUp animated').show();
      });

      $(".slider-start").on('translate.owl.carousel', function() {
        $('.slider-text a').removeClass('fadeInUp animated').hide();
      });

      /* Instagram Slider  */
      $('.instagram-slider').owlCarousel({
        loop: true,
        nav: false,
        items: 5,
        autoplay: true,
        dots: false,
        responsive: {
          320: {
            items: 1
          },
          480: {
            items: 2
          },
          768: {
            items: 3
          },
          992: {
            items: 4
          },
          1300: {
            items: 5
          }
        }

      });

      /* Product filter   */
      if ($.fn.imagesLoaded) {
        $('.main-product').imagesLoaded(function() {
          var $grid = $('.grid').isotope({
            // options
            itemSelector: '.grid-item',
            stagger: 30,
          });


          //Product filter active menu
          $('.pro-tab-button .filter').on('click', function() {
            $('.pro-tab-button .filter').removeClass('active');
            $(this).addClass('active');
          });


          $('.pro-tab-button').on('click', 'li', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
              filter: filterValue
            });
          });

        });


        /* Blog filter   */

        $('.blog-wrapper').imagesLoaded(function() {
          var $grid = $('.grid').isotope({
            // options
            itemSelector: '.grid-item',
            stagger: 30,
          });


          //Blog filter active menu
          $('.pro-tab-button .filter').on('click', function() {
            $('.pro-tab-button .filter').removeClass('active');
            $(this).addClass('active');
          });


          $('.pro-tab-button').on('click', 'li', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
              filter: filterValue
            });
          });

        });
      }


      /* Client Slider  */
      $('.client-car').owlCarousel({
        loop: true,
        nav: false,
        items: 5,
        autoplay: true,
        dots: false,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
          320: {
            items: 1
          },
          576: {
            items: 2
          },

          768: {
            items: 3
          },
          992: {
            items: 4
          }
        }

      });

      /* Testimonial Slider  */
      $('.testimonial-carousel').owlCarousel({
        loop: true,
        nav: false,
        items: 2,
        autoplay: true,
        dots: true,
        responsive: {
          320: {
            items: 1
          },
          576: {
            items: 1
          },

          768: {
            items: 1
          },
          992: {
            items: 2
          }
        }

      });

      /* Product Slider  */
      $('.prod-carousel').owlCarousel({
        loop: true,
        nav: false,
        items: 3,
        autoplay: true,
        dots: false,
        responsive: {
          320: {
            items: 1
          },
          600: {
            items: 2
          },
          768: {
            items: 2
          },
          1200: {
            items: 3
          }

        }

      });

      /* Category Slider  */
      $('.category-carousel').owlCarousel({
        loop: true,
        nav: false,
        items: 3,
        autoplay: true,
        dots: false,
        responsive: {
          320: {
            items: 1
          },
          440: {
            items: 2
          },
          900: {
            items: 3
          },
          1200: {
            items: 4
          }

        }

      });



      $('.trigger').on('click', function(e) {
        e.preventDefault();
        var mask = '<div class="mask-overlay">';

        $('.quickview-wrapper').toggleClass('open');
        $(mask).hide().appendTo('body').fadeIn('fast');
        $('.mask-overlay, .close-qv').on('click', function() {
          $('.quickview-wrapper').removeClass('open');
          $('.mask-overlay').remove();
        });
      });


      //Product plus minus

      $(".cart-plus-minus-button").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
      $(".qtybutton").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
          var newVal = parseFloat(oldValue) + 1;
        } else {
          // Don't allow decrementing below zero
          if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
          } else {
            newVal = 0;
          }
        }
        $button.parent().find("input").val(newVal);
      });


      /*---------------------
         Back to Top
         --------------------- */


      var backtotop = $(".backtotop");

      var windo = $(window),
        HtmlBody = $('html, body');

      backtotop.on('click', function() {
        HtmlBody.animate({
          scrollTop: 0
        }, 1500);
      });


      /*---------------------
          Search toggle class
          ------------------------- */

      $(".top-search a").on('click', function() {
        $(".search-input").toggleClass("active");
      });


      /*---------------------
          Live search suggestions
          ------------------------- */

      function liveSearchEscape(str) {
        return String(str)
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;')
          .replace(/"/g, '&quot;')
          .replace(/'/g, '&#39;');
      }

      function liveSearchRender($box, items) {
        if (!items.length) {
          $box.html('<div class="live-search-empty">No products found</div>').addClass('active');
          return;
        }

        var html = items.map(function(item) {
          return '<a class="live-search-item" href="' + item.url + '">' +
            '<img src="' + item.image + '" alt="">' +
            '<span class="live-search-item-name">' + liveSearchEscape(item.name) + '</span>' +
            '<span class="live-search-item-price">$' + liveSearchEscape(item.price) + '</span>' +
            '</a>';
        }).join('');

        $box.html(html).addClass('active');
      }

      function liveSearchBind(inputSelector, boxSelector) {
        var $input = $(inputSelector);
        var $box = $(boxSelector);
        var timer = null;
        var currentRequest = null;

        if (!$input.length || !$box.length) {
          return;
        }

        $input.on('input', function() {
          var term = $(this).val().trim();

          clearTimeout(timer);

          if (currentRequest) {
            currentRequest.abort();
          }

          if (term.length < 2) {
            $box.removeClass('active').empty();
            return;
          }

          timer = setTimeout(function() {
            currentRequest = $.getJSON('/search-suggestions', { q: term })
              .done(function(items) {
                liveSearchRender($box, items);
              })
              .fail(function(jqXHR) {
                if (jqXHR.statusText !== 'abort') {
                  $box.removeClass('active').empty();
                }
              });
          }, 300);
        });

        $(document).on('click', function(e) {
          if (!$(e.target).closest($input).length && !$(e.target).closest($box).length) {
            $box.removeClass('active');
          }
        });
      }

      liveSearchBind('#live-search-input', '#live-search-results');
      liveSearchBind('#live-search-input-mobile', '#live-search-results-mobile');



      /*---------------------
          Cart top show hide toggle
          ------------------------- */

      $(".top-cart > a").on('click', function() {
        $(".cart-drop").toggleClass("active");
      });

      /*---------------------
          Menu three toggle
          ------------------------- */

      $(".menu-btn a").on('click', function() {
        $(this).toggleClass("active");

        $(".mainmenu").toggleClass("active");

        $('body').toggleClass('menu-open');

      });


      /*---------------------
            Headroom
            ------------------------- */

      $('#header').each(function() {

        var header = document.querySelector("#header");

        var headroom = new Headroom(header, {
          tolerance: {
            down: 10,
            up: 20
          },
          offset: 205
        });
        headroom.init();

      });

      var myElement = document.querySelector(".mobile-header");
      var headroom = new Headroom(myElement);

      headroom.init({
        offset: 80,

        tolerance: {
          up: 80,
          down: 80
        },

        classes: {
          top: "headroom--top"

        }
      });



    },

    /*==================================*/
    /*=           Mobile Menu          =*/
    /*==================================*/

    mobileMenu: function() {

      var Accordion = function(el, multiple) {
        this.el = el || {};

        this.multiple = multiple || false;

        var dropdownlink = this.el.find('.link');
        dropdownlink.on('click', {
            el: this.el,
            multiple: this.multiple
          },
          this.dropdown);
      };

      Accordion.prototype.dropdown = function(e) {
        e.preventDefault();
        var $el = e.data.el,
          $this = $(this),

          $next = $this.next();

        $next.slideToggle();
        $this.parent().toggleClass('open');

        if (!e.data.multiple) {
          //show only one menu at the same time
          $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
        }
      }

      var accordion = new Accordion($('#mobilemenu'), false);



      $(".accordion-wrapper .mobile-open").on('click', function() {
        $(".accordion").toggleClass("active");
      });

      $(".accordion .closeme").on('click', function() {
        $(this).parents('.accordion').removeClass("active");
      });


      $('.mobile-open').on('click', function(e) {
        e.preventDefault();
        var mask = '<div class="mask-overlay">';

        $('body').toggleClass('active');
        $(mask).hide().appendTo('body').fadeIn('fast');
        $('.mask-overlay, .closeme').on('click', function() {
          $('.accordion').removeClass('active');
          $('.mask-overlay').remove();
        });
      });





    }


  };

  THEMEIM.documentOnReady = {
    init: function() {
      THEMEIM.initialize.init();

    },
  };

  THEMEIM.documentOnLoad = {
    init: function() {
      $("#loader-wrapper").fadeOut("slow");
      $('#exampleModalCenter').modal('show');
      $('#exampleModaltwo').modal('show');
    },


  };

  THEMEIM.documentOnResize = {
    init: function() {

    },
  };

  THEMEIM.documentOnScroll = {
    init: function() {


      if ($(this).scrollTop() > 150) {
        $('header').addClass("hide-topbar")
      } else {
        $('header').removeClass("hide-topbar")
      }



      /* Back to top */
      if ($(this).scrollTop() > 400) {
        $(".backtotop").fadeIn(500);
      } else {
        $(".backtotop").fadeOut(500);
      }



    },


  };

  // Initialize Functions
  $(document).ready(THEMEIM.documentOnReady.init);
  $(window).on('load', THEMEIM.documentOnLoad.init);
  $(window).on('resize', THEMEIM.documentOnResize.init);
  $(window).on('scroll', THEMEIM.documentOnScroll.init);

})(jQuery);