(function($) {
"use strict";
    $(document).ready(function (){
        //remove br from all page
        if (window.matchMedia('(max-width: 575px)').matches) {
            $('br').remove();
        }
        
        //caches a jQuery object containing the header element
        var nav = $(".classiera_nav");
        // Cache selectors
        var lastId,
            topMenu = $(".classiera_nav__navbar"),
            topMenuHeight = topMenu.outerHeight()+15,
            // All list items
            menuItems = topMenu.find("a"),
            // Anchors corresponding to menu items
            scrollItems = menuItems.map(function(){
                var item = $($(this).attr("href"));
                if (item.length) {
                    return item; 
                }
            });
        // Bind click handler to menu items
        // so we can get a fancy scroll animation
        menuItems.on('click', function(e){
            var href = $(this).attr("href"),
                offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
            $('html, body').stop().animate({
                scrollTop: offsetTop
            }, 300);
            e.preventDefault();
        });
        
            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                var sec = $(".ani").offset().top - 400;
                if (scroll >= sec) {
                    $(".ani-main").addClass("ani-sta");
                }
            });


        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 100) {
                nav.addClass("darknav");
                $('header').css('background-size', 100 + parseInt(scroll / 10, 0) + '% ');
            } else {
                nav.removeClass("darknav");
                $('header').css('background-size', 'cover');
            }

            if (window.matchMedia('(min-width: 1200px)').matches) {
                if (scroll >= 100) {
                    nav.addClass("darknav");
                    $('header').css('background-size', 100 + parseInt(scroll / 10, 0) + '% ');
                } else {
                    nav.removeClass("darknav");
                    $('header').css('background-size', 'cover');
                }

            } else {
                /* Reset for CSS changes – Still need a better way to do this! */
                $('header').css('background-size', 'cover');
            }

            // Get container scroll position
            var fromTop = $(this).scrollTop()+topMenuHeight;

            // Get id of current scroll item
            var cur = scrollItems.map(function(){
                if ($(this).offset().top < fromTop){
                    return this;
                }
            });
            // Get the id of the current element
            cur = cur[cur.length-1];
            var id = cur && cur.length ? cur[0].id : "";

            if (lastId !== id) {
                lastId = id;
                // Set/remove active class
                menuItems
                    .parent().removeClass("active")
                    .end().filter("[href='#"+id+"']").parent().addClass("active");
            }
        });

        // slick carousel
        jQuery('.carousel').each(function () {
            var $this = jQuery(this);
            $this.slick({
                responsive: [
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: $this.data("responsive-lg"),
                            infinite: true,
                            dots: false,
                            mobileFirst: true,
                            variableWidth: false,
                            centerPadding: '150px',
                            centerMode: true
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: $this.data("responsive-md"),
                            infinite: false,
                            dots: false,
                            mobileFirst: true,
                            variableWidth: false,
                            centerPadding: '50px',
                            centerMode: true
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: $this.data("responsive-sm"),
                            infinite: false,
                            mobileFirst: true,
                            variableWidth: false,
                            centerMode: true,
                            centerPadding: '20px'
                        }
                    },
                    {
                        breakpoint: 575,
                        settings: {
                            mobileFirst: true,
                            slidesToShow: $this.data("responsive-xs"),
                            infinite: false,
                            centerMode: true,
                            variableWidth: false,
                            centerPadding: '0',
                            autoplay: false
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });
        });

        //back to top 
        if ($('#back-to-top').length) {
            var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
            backToTop();
            $(window).on('scroll', function () {
                backToTop();
            });
            $('#back-to-top').on('click', function (e) {
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: 0
                }, 500);
            });
        }
    });
})(jQuery);

(function(){
      var words = [
          'Local',
          'Portal',
          'Classified',
          'Online',
          'Hotel',
          'Automobile',
          'Online',
          'Realestate',
          'Travel',
          'Listing',
          'Spa',
          'Shop',
          'Doctors',
          'Sports',
          'Education',
          'Hospital',
          'Digital Product',
          'Pets'
          ], i = 0;
      setInterval(function(){
          $('#changingword').fadeOut(function(){
              $(this).html(words[i=(i+1)%words.length]).fadeIn();
          });
      }, 1500);
        
  })();