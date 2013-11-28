/*------------------------------------------------*/
/*	Fire up functions on Page load
/*------------------------------------------------*/
jQuery(document).ready(function () {
  ttMobileMenu();
  NavSetup();
  initNav();
  jQuery("#menu-main-nav li:has(ul)").addClass("parent");
  iex();
  initScrollTop();
  //since version 3.0.2, removed old tabs init code and replace with following function.
  initTabs();
  jQuery("ul.products .product").find('br').remove();
});


/*----------------------*/
/* Tabs
/*----------------------*/
function initTabs(){
  
  //Added since 3.0.2 dev 4. 
  //tabs init code, added with browser url sniff to get tab id to allow activating tab via link
  //example url http://localhost:8888/karma-experimental/shortcodes/tabs-accordion/?tab=2
  
  var tab_id = window.location.search.split('?tab='); //find ?tab=2 in browser url.
	      if(tab_id){ //if there is tab id found. We use tab_id[1], which is the number.
	        var tab_index = tab_id[1]-1; //minus by 1, so as to get the tab index which starts from 0
			jQuery( '.tabs-area' ).tabs({ fx: { opacity: 'toggle' },selected:tab_index}); //assign tab index to init code
	      }else{
	        //if there is no tab id found in browser url, we set it to 0, which is the first tab
  			jQuery( '.tabs-area' ).tabs({ fx: { opacity: 'toggle' },selected:0});	      
	      }  

}


/*------------------------------------------------*/
/*	Main Navigation
/*------------------------------------------------*/
function NavSetup() {
var mainNav = jQuery('#menu-main-nav');
    var lis = mainNav.find('li');
    var shownav = jQuery("#menu-main-nav");
    lis.children('ul').wrap('<div class="c" / >');
    var cElems = jQuery('.c');
    cElems.wrap('<div class="drop" / >');
    cElems.before('<div class="t"></div>');
    cElems.after('<div class="b"></div>');
    jQuery(shownav).find(".sub-menu").css({
      display: "block"
    });
}

function initNav() {
  var nav = jQuery("#menu-main-nav");
  var duration = 260;
  jQuery(nav).find(".sub-menu").css({
    left: 0
  });
  jQuery(nav).find("> li").each(function () {
    var height = jQuery(this).find("> .drop").height();
    jQuery(this).find("> .drop").css({
      display: "none",
      height: 0,
      overflow: "hidden"
    });
    jQuery(this).find(".drop li > .drop").css({
      display: "none",
      width: 0
    });
    if (!jQuery.browser.msie) {
      jQuery(this).find("> .drop").css({
        "opacity": 0
      });
      jQuery(this).find(".drop li > .drop").css({
        "opacity": 0
      })
    }
    jQuery(this).mouseenter(function () {
      jQuery(this).addClass("hover");
      var drop = jQuery(this).find("> .drop");
      if (jQuery.browser.msie) {
        jQuery(drop).css({
          display: "block"
        }).stop().animate({
          "height": height
        }, duration, function () {
          jQuery(this).css({
            "overflow": "visible"
          })
        })
      }
      else {
        jQuery(drop).css({
          display: "block"
        }).stop().animate({
          "height": height,
          "opacity": 1
        }, duration, function () {
          jQuery(this).css({
            "overflow": "visible"
          })
        })
      }
    }).mouseleave(function () {
      var _this = jQuery(this);
      if (jQuery.browser.msie) {
        jQuery(this).find("> .drop").stop().css({
          "overflow": "hidden"
        }).animate({
          "height": 0
        }, duration, function () {
          jQuery(_this).removeClass("hover")
        })
      }
      else {
        jQuery(this).find("> .drop").stop().css({
          "overflow": "hidden"
        }).animate({
          "height": 0,
          "opacity": 0
        }, duration, function () {
          jQuery(_this).removeClass("hover")
        })
      }
    });
    jQuery(this).find(".drop ul > li ").mouseenter(function () {
      jQuery(this).addClass("hover");
      var pageW = getPageSize()[2];
      if (pageW < jQuery(this).offset().left + 236 * 2) {
        jQuery(this).find("> .drop").css({
          left: 'auto',
          right: 236
        })
      }
      if (jQuery.browser.msie) {
        jQuery(this).find("> .drop").css({
          display: 'block'
        }).stop().animate({
          "width": 236
        }, duration, function () {
          jQuery(this).css({
            overflow: 'visible'
          })
        })
      }
      else {
        jQuery(this).find("> .drop").css({
          display: 'block'
        }).stop().animate({
          "width": 236,
          "opacity": 1
        }, duration, function () {
          jQuery(this).css({
            overflow: 'visible'
          })
        })
      }
    }).mouseleave(function () {
      jQuery(this).removeClass("hover");
      if (jQuery.browser.msie) {
        jQuery(this).find("> .drop").stop().css({
          overflow: 'hidden'
        }).animate({
          width: 0
        }, duration, function () {
          jQuery(this).css({
            display: 'none'
          })
        })
      }
      else {
        jQuery(this).find("> .drop").stop().css({
          overflow: 'hidden'
        }).animate({
          width: 0,
          "opacity": 0
        }, duration, function () {
          jQuery(this).css({
            display: 'none'
          })
        })
      }
    })
  })
}

function getPageSize() {
  var xScroll, yScroll;
  if (window.innerHeight && window.scrollMaxY) {
    xScroll = document.body.scrollWidth;
    yScroll = window.innerHeight + window.scrollMaxY
  }
  else if (document.body.scrollHeight > document.body.offsetHeight) {
    xScroll = document.body.scrollWidth;
    yScroll = document.body.scrollHeight
  }
  else if (document.documentElement && document.documentElement.scrollHeight > document.documentElement.offsetHeight) {
    xScroll = document.documentElement.scrollWidth;
    yScroll = document.documentElement.scrollHeight
  }
  else {
    xScroll = document.body.offsetWidth;
    yScroll = document.body.offsetHeight
  }
  var windowWidth, windowHeight;
  if (self.innerHeight) {
    windowWidth = self.innerWidth;
    windowHeight = self.innerHeight
  }
  else if (document.documentElement && document.documentElement.clientHeight) {
    windowWidth = document.documentElement.clientWidth;
    windowHeight = document.documentElement.clientHeight
  }
  else if (document.body) {
    windowWidth = document.body.clientWidth;
    windowHeight = document.body.clientHeight
  }
  if (yScroll < windowHeight) {
    pageHeight = windowHeight
  }
  else {
    pageHeight = yScroll
  }
  if (xScroll < windowWidth) {
    pageWidth = windowWidth
  }
  else {
    pageWidth = xScroll
  }
  return [pageWidth, pageHeight, windowWidth, windowHeight]
}


/*------------------------------------------------*/
/*	Portfolio Image Fade
/*------------------------------------------------*/
(function (jQuery) {
  jQuery(window).load(function () {

    jQuery('[class^="attachment"]').each(function (index) {
      var t = jQuery('[class^="attachment"]').length;
      if (t > 0) { // if there is image length, we fade in
        jQuery(this).delay(400 * index).fadeIn(500);
      }
    });

  });
})(jQuery);


/*------------------------------------------------*/
/*	Portfolio Image Hover
/*------------------------------------------------*/
(function (jQuery) {
  jQuery(document).ready(function () {
    jQuery('.preload').hover(function () {
      jQuery(this).children().first().children().first().stop(true);
      jQuery(this).children().first().children().first().fadeTo('normal', .90)
    }, function () {
      jQuery(this).children().first().children().first().stop(true);
      jQuery(this).children().first().children().first().fadeTo('normal', 0)
    })
  })
})(jQuery);


/*------------------------------------------------*/
/*	Button Hover
/*------------------------------------------------*/
if (jQuery.browser.msie) { /* time to download a new browser */
}
else {
  jQuery(document).ready(function () {
    jQuery(".ka_button, #ka-submit, #searchform #searchsubmit, .ka-form-submit, #mc_signup #mc_signup_submit, .fade-me").hover(function () {
      jQuery(this).stop().animate({
        opacity: 0.7
      }, 250)
    }, function () {
      jQuery(this).stop().animate({
        opacity: 1.0
      }, 250)
    })
  });
  jQuery(document).ready(function () {
    jQuery(".social_icons a").hover(function () {
      jQuery(this).stop().animate({
        opacity: 0.65
      }, 200)
    }, function () {
      jQuery(this).stop().animate({
        opacity: 1
      }, 200)
    })
  });
}


/*------------------------------------------------*/
/*	Scroll to Top
/*------------------------------------------------*/

function initScrollTop() {
  var change_speed = 1200;
  jQuery('a.link-top').click(function () {
    if (!jQuery.browser.opera) {
      jQuery('body').animate({
        scrollTop: 0
      }, {
        queue: false,
        duration: change_speed
      })
    }
    jQuery('html').animate({
      scrollTop: 0
    }, {
      queue: false,
      duration: change_speed
    });
    return false
  })
}


/*------------------------------------------------*/
/*  Mobile Menu
/*------------------------------------------------*/
function ttMobileMenu() {
  var mobileMenuClone = jQuery('#menu-main-nav').clone().attr('id', 'tt-mobile-menu-list');
 
  function ttMobileMenu() {
    var windowWidth = jQuery(window).width();
 
    if (windowWidth <= 775) {
      if (!jQuery('#tt-mobile-menu-button').length) {
        jQuery('<a id="tt-mobile-menu-button" href="#tt-mobile-menu-list"><span></span></a>').prependTo('#header');
        mobileMenuClone.insertAfter('#tt-mobile-menu-button').wrap('<div id="tt-mobile-menu-wrap" />');
        tt_menu_listener();
      }else{
                jQuery('#tt-mobile-menu-button').css('display', 'block');
            }
    }
    else {
            jQuery('#tt-mobile-menu-button').css('display', 'none');
      mobileMenuClone.css('display', 'none');
    }
  }
  ttMobileMenu();
 
  function tt_menu_listener() {
    jQuery('#tt-mobile-menu-button').click(function (e) {
      if (jQuery('body').hasClass('ie8')) {
 
        var mobileMenu = jQuery('#tt-mobile-menu-list');
 
        if (mobileMenu.css('display') === 'block') {
          mobileMenu.css({
            'display': 'none'
          });
        }
        else {
          var mobileMenu = jQuery('#tt-mobile-menu-list');
          mobileMenu.css({
            'display': 'block',
            'height': 'auto',
            'z-index': 999,
            'position': 'absolute'
          });
        }
 
      }
      else {
 
        jQuery('#tt-mobile-menu-list').stop().slideToggle(500);
 
      }
 
      e.preventDefault();
    });
 
    jQuery('#tt-mobile-menu-list').find('> .menu-item').each(function(){
 
      var $this = jQuery(this),
        opener = $this.find('> a'),
        slide = $this.find('> .sub-menu');
 
    })
  }
 
  jQuery(window).resize(function () {
    ttMobileMenu();
  });
 
  jQuery(window).load(function(){
      jQuery('#tt-mobile-menu-list').hide();
   });
 
  jQuery(document).ready(function(){
      jQuery('#tt-mobile-menu-list').hide();
   });  
 
}



/*------------------------------------------------*/
/*	IE
/*------------------------------------------------*/
function iex() {
  if (jQuery.browser.msie || jQuery.browser.opera) {
    jQuery(window).load(function () {
      jQuery('.big-banner #main .main-area').css("padding-top", "118px");
    });
  }
}