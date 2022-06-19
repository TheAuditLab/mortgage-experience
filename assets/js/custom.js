/*-------------------------------
Slider
------------------------------*/
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

