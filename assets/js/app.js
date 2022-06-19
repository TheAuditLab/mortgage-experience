(function ($) {
  "use strict";

  jQuery(document).ready(function ($) {

      $(".anim-slider").animateSlider(
          {
              autoplay	:true,
              interval	:5000,
              animations 	:
                  {
                      0	: 	//Slide No1
                          {
                              img	:
                                  {
                                      show 	  : "fadeInRightBig",
                                      hide 	  : "fadeOut",
                                      delayShow : "delay0-5s"
                                  }
                          },
                      1	: //Slide No2
                          {
                              img	:
                                  {
                                      show 	  : "slideInRight",
                                      hide 	  : "fadeOut",
                                      delayShow : "delay0-1s"
                                  }
                          },
                      2	: //Slide No3
                          {
                              img	:
                                  {
                                      show 	  : "slideInRight",
                                      hide 	  : "fadeOut",
                                      delayShow : "delay0-1s"
                                  }
                          },
                    3	: //Slide No4
                        {
                          img	:
                              {
                                show 	  : "slideInRight",
                                hide 	  : "fadeOut",
                                delayShow : "delay0-1s"
                              }
                        }
                  }
          });

    /*------------------------------
        Offside Responsive Menu JS
    ---------------------------------*/
    $(".mobile-menu").on('click', function () {
      $(".off-canvas-responsive-menu").addClass('show');
    });

    $(".btn-close-mobile, .off-canvas-overlay").on('click', function () {
      $(".off-canvas-area-wrapper,.off-canvas-responsive-menu,.off-canvas-search-box").removeClass('show');
    });

    $(function() {
      $('#ChangeToggle').click(function() {
        $('.mobile-menu').toggleClass('hidden');
        $('.btn-close-mobile').toggleClass('hidden');
      });
    });


    /*------------------------------
        Offside Search Box JS
    ---------------------------------*/
    $(".search-box-open").on('click', function () {
      $(".off-canvas-search-box").addClass('show');
    });

    // Sticky Header Height Fix
    var searchBoxHeight = $("header").outerHeight();
    $("header.header-area-wrapper:not('.transparent-header') + div").css('margin-top', searchBoxHeight);


    /*---------------------------
       Slicknav JS
    ------------------------------*/
  //  $(".mobile").slicknav({
   //   removeClasses: true,
   //   closedSymbol: '<i class="fa fa-angle-down"></i>',
    //  openedSymbol: "-",
    //  prependTo: '.off-canvas-responsive-menu .off-canvas-content ',
    //  nestedParentLinks: false
 //   });




    /*=====================================
        Smooth Scroll JS
      ======================================*/
  $(".smooth-scroll").smoothScroll({
    speed: 1000
  });

  }); //End Ready Function

  jQuery(window).on('scroll', function () {
    /*---------------------------
        Sticky Header JS
     ------------------------------*/
    var docpos = $(document).scrollTop();

    if (5 < docpos) {
      $(".sticky-header").addClass('sticky');
    } else {
      $(".sticky-header").removeClass('sticky');
    }
  });

  jQuery(window).on('load', function () {
    /*---------------------------
        Parallax Bg JS
    ---------------------------*/
    var parallaxActive = $(".parallaxBg");
    if (parallaxActive.length) {
      parallaxActive.jarallax({
        speed: 0.2
      });
    }
  });

  /*-------------------------------
    Tabs
   ------------------------------*/
  $('.tabs_default').tabslet();

  $('.tabs_active').tabslet({
    active: 1
  });

  $('.tabs_hover').tabslet({
    mouseevent: 'hover',
    attribute: 'href',
    animation: false
  });

  $('.tabs_animate').tabslet({
    mouseevent: 'click',
    attribute: 'href',
    animation: true
  });

  $('.tabs_rotate').tabslet({
    autorotate: true,
    delay: 3000
  });

  $('.tabs_controls').tabslet();

  $('.before_event').tabslet();
  $('.before_event').on("_before", function() {
    alert('This alert comes before the tab change!')
  });

  $('.after_event').tabslet({
    animation: true
  });
  $('.after_event').on("_after", function() {
    alert('This alert comes after the tab change!')
  });


  $(".tabimagetwo").hide();
  $(".tab1, .tab2").bind("click", function () {
    $(".tabimageone, .tabimagetwo").hide();
    if ($(this).attr("class") == "tab1")
    {
      $(".tabimageone").show();
    }
    else
    {
      $(".tabimagetwo").show();
    }
  });


}(jQuery));

$('nav ul > li.menu-item-has-children').on({
  mouseenter: function () {
    $(this).find('ul.sub-menu').addClass('open');
  },

  mouseleave: function () {
    $(this).find('ul.sub-menu').removeClass('open');
  }
});

/*---------------------------
    AOS
 ------------------------------*/

AOS.init({
  // Global settings:
  disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
  startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
  initClassName: 'aos-init', // class applied after initialization
  animatedClassName: 'aos-animate', // class applied on animation
  useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
  disableMutationObserver: false, // disables automatic mutations' detections (advanced)
  debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
  throttleDelay: 99, // the delay on throttle used while scrolling the page (advanced)


  // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
  offset: 120, // offset (in px) from the original trigger point
  delay: 0, // values from 0 to 3000, with step 50ms
  duration: 400, // values from 0 to 3000, with step 50ms
  easing: 'ease', // default easing for AOS animations
  once: true, // whether animation should happen only once - while scrolling down
  mirror: false, // whether elements should animate out while scrolling past them
  anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation

});

/*---------------------------
    AOS with Classes
 ------------------------------*/

function ismatch(str){
  var ret = null;
  var tab = ['data-aos_', 'data-aos-delay_', 'data-aos-duration_', 'data-aos-easing_'];
  Object.values(tab).forEach( function (value) {
    if (String(str).match(value)){
      ret = str.split('_');
      return false;
    }
  });
  return ret;
}
jQuery(document).ready(function ($) {
  $('.animatedDiv').each(function () {
    var $this = $(this);
    var tab = $this.attr('class').split(' ');
    var keep;
    Object.values(tab).forEach(function (item) {
      var ello = ismatch(item)
      if (ello !== null)
        $this.attr(ello[0], ello[1]);
    });

  });
  AOS.init();
});

/*---------------------------
    Year
 ------------------------------*/

const d = new Date();
let year = d.getFullYear();
document.getElementById("year").innerHTML = year;

/*---------------------------
    Calculators
 ------------------------------*/

function monthlyPayment()  {
          //$('#input_month_abc').css('display','block');
          document.getElementById('input_month_abc').style.display='block';
          document.getElementById('input_year').style.display='none';
          var loanamt=parseFloat(document.getElementById('mortgage_amnt').value);
          var rate=parseFloat(document.getElementById('mortgage_rt').value);
          var years=parseFloat(document.getElementById('mortgage_yrs').value);
          //here is the amortization formula:
          var payment2=loanamt*Math.pow((1+(rate/100)),years)*(rate/100)*(1/(Math.pow(1+(rate/100),years)-1))*(1/12);
          var payment=Math.round(payment2*100)/100;
          document.getElementById('lins_totIns_month').value = "£" + (payment).toLocaleString('en', { minimumFractionDigits: 2 });
          $(".tabimageone").hide(); //hides div.
          $("#tab-1").addClass("no-margin");
          //;
        }

function interestOnly() {
  var loanamt = parseFloat(document.getElementById('mortgage_amnt').value);
  var rate = parseFloat(document.getElementById('mortgage_rt').value);
  var interest2 = rate * loanamt / 1200;
  var interest = Math.round(interest2 * 100) / 100;
  document.getElementById('input_month_abc').style.display = 'none';
  document.getElementById('input_year').style.display = 'block';
  document.getElementById('lins_totIns_year').value = "£" + (interest).toLocaleString('en', {minimumFractionDigits: 2});
  $(".tabimageone").hide(); //hides div.
  $("#tab-1").addClass("no-margin");
}

function ClearFields() {

  document.getElementById("mortgage_amnt").value = "";
  document.getElementById("mortgage_rt").value = "";
  document.getElementById("mortgage_yrs").value = "";
  $("#input_month_abc").hide(); //hides div.
  $("#input_year").hide(); //hides div.
  $(".tabimageone").show(); //shows div.
  $("#tab-1").removeClass("no-margin");
}




function go2()  {
// user inputs:
  var ap1i = parseFloat(document.getElementById('hpib_salary1').value);
  var ap2i = parseFloat(document.getElementById('hpib_salary2').value);
  var apit = Math.round((ap1i+ap2i)*100)/100; // joint  gross income
  document.getElementById('hpib_salary12').value = apit;
  var ap1net = ap1i; //app 1 net income
  var ap2net = ap2i; //app 2 net income
  var ap12net = Math.round((ap1net+ap2net)*100)/100; //joint net income
  document.getElementById('hpib_salary12').value = ap12net;
  var the25 = parseFloat(document.getElementById('hpib_two5').value);
  document.getElementById('hpib_net2').value= ap12net;
  document.getElementById('hpib_sum25').value= "£" + (Math.round((the25*ap12net)*1000)/1000).toLocaleString('en', { minimumFractionDigits: 2 }); //2nd result
  document.getElementById('resultsof').style.display='block';
  $(".tabimagetwo").hide(); //hides div.
  $("#tab-2").addClass("no-margin");

}

//document.getElementById('hpib_salary12').disabled=true;

function ClearFields3() {

  document.getElementById("hpib_salary1").value = "";
  document.getElementById("hpib_salary2").value = "";
  document.getElementById("hpib_salary12").value = "";
  $("#resultsof").hide(); //hides div.
  $(".tabimagetwo").show(); //shows div.
  $("#tab-2").removeClass("no-margin");

}

