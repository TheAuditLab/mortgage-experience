<?php
require_once(get_template_directory() . "/libs/client/base.php");

/**
 * Class pagehomeimprovement
 * Handles the displaying of the 404 page,
 * as well as any additional functionality
 */
class pageglazing extends CL_Base
{
    /**
     * Construct for the controller
     *
     * @param null $body
     */
    public function __construct($body = null)
    {
        // Just necessary DO NOT REMOVE.
        parent::__construct();

        // Add any body classes passed
        if (!empty($body)) {
            $this->addBodyClasses($body);
        }

        // Include any helpers you need for the views
        // Within the page controller.
        $this->addViewHelpers(array('Data', 'Image', 'Menu'));
        // Include the relevant view file.
        // Basically we are using the file name of this file
        // To generate the include. So homepage.php
        $this->addIncludes(basename(__FILE__), true);
    }
}
?>
<div style="overflow-x: hidden">
<div class="height-36 lg-height-36 xl-height-40 relative bg-darken-4-blue-title bg-cover bg-center mb5 main-header" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/glazing-main.jpg'); background-size: cover; background-position: 0 60%; visibility: visible;">
    <div class="container full-h sm-flex flex-center relative">

        <div class="sm-col col-12 md-col-6 lg-col-6">
            <h1 class="py3 px0 sm-px3 lg-p0 regular h0-responsive white header-lineheight">
                Generating over 5,000 leads a month for our home improvement clients
            </h1>

        </div>

        <div class="col-12 md-col-6 md-right overlap center phone-overlap">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/co-social.png" style="z-index: 3; margin-bottom: 2rem" alt="">
        </div>
    </div>
</div>

<!-- CONTENT CENTERD BLOCK -->
<section class="overflow-hidden overlap-clear phone-clear py2 lg-py3 xl-py4 mb5 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s" style="visibility: visible; animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;" >
    <div class="container px2 xl-px5 clearfix lg-center">
        <h2 class="h1-responsive lg-mw-26 px2 lg-mx-auto mb4 ">
        Experts in lead generation for the home improvement industry across the UK and Europe</h2>

        <div class="darken-4 xl-px5 px2 ls-3">
            <p>Over the last decade, we have worked with some of the UK’s best known home improvement brands. From windows and doors through to kitchens and conservatories, we know how to both build brands and drive leads, across every corner of the industry.</p>
            <p>Our approach to lead generation, which combines strategic campaign execution with deep dive analytics, has helped us to drive thousands of leads every month for clients, as well as achieving year-on-year growth.</p>
            <p>We understand this sector, so we know how to help you make your mark on it.</p>

            <a href="https://www.youtube.com/watch?v=WVYZ8AighT0" class="popup-youtube black block no-underline"><img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/ClearviewVideoThumbnail.png" alt="Watch Our Client Focus Video" style="border: 1px solid #cccccc; border-radius: 5px"></a>
            <p class="btn px2 sans regular mt2" style="border: 1px solid #cccccc; border-radius: 5px;"><a href="https://www.youtube.com/watch?v=WVYZ8AighT0" class="popup-youtube black no-underline"><i class="fa fa-video-camera mr1" aria-hidden="true"></i> Watch Our Client Focus Video</a></p>
        </div>
    </div>
</section>

<!-- IMAGE BLOCK WITH CENTERED CONTENT -->
<div class="height-30 sm-height-40 md-height-50 lg-full-height mb0 bg-cover bg-center wow fadeIn height-override md-bg-afixed" id="conservatoryoutlet" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/co-new.jpg'); background-size: cover;">
    <div class="bg-darken-4 full-h overflow-hidden">

        <div class="table full-h">
            <div class="table-cell center">
                <div class="container">
                    <h2 class="mb1 ls-n2 regular h1-responsive mw-50 mx-auto white landing-page-title">
                        Conservatory Outlet
                    </h2>
                    <p class="white lighten-6 mw-28 mx-auto xl-px5 px5 ls-3 h3">Growing a 2 showroom business in Yorkshire to a national brand with 35+ showrooms.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- 3 Column Blocks  -->
<section class="overflow-hidden clearfix mx-auto wow fadeIn" style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="0.5s" data-wow-duration="1s">
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-18 bg-center flex flex-center glazing-blue">

        <div class="counter counter-right white border border-white center" id="counter-1" data-count="42" data-duration="4000"><p class="block mt4 mb0"><span>0</span>%</p><p class="h4 px2 standard">increase in<br/> traffic</p></div>

    </div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-18 bg-center flex flex-center glazing-blue">

        <div class="counter white border border-white center" id="counter-2" data-count="3" data-duration="4000"><p class="block mt4 mb0"><span>0</span>+</p><p class="h4 px2 standard">million visits<br/> generated</p></div>

    </div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-18 bg-center flex flex-center glazing-blue">

        <div class="counter counter-left white border border-white center" id="counter-3" data-count="20" data-duration="4000"><p class="block mt4 mb0"><span>0</span>%</p><p class="h4 px2 standard">increase in leads <br/>year on year</p></div>

    </div>
</section>

<!-- 3 Column Image -->
<section class="overflow-hidden clearfix mx-auto wow fadeIn"  style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="0.5s" data-wow-duration="1s">
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-33 bg-center" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/co-3.jpg'); visibility: visible;"></div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-33 bg-top" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/co-4.jpg'); visibility: visible;"></div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-33 bg-center" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/co-5.png'); visibility: visible;"></div>
</section>

<section class="overflow-hidden clearfix mx-auto wow fadeIn" style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn; visibility: visible;" data-wow-delay="0.5s" data-wow-duration="1s">

    <div class="col col-12 md-col-6 bg-white wow fadeInUp height-auto md-height-45 lg-height-44 flex flex-center p3 md-p5" data-wow-duration="0.5s" data-wow-delay="0" style="visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">
        <div class="black md-p4">
            <h3 class="h2-responsive mt0 mb3" style="font-size: 2.2em">Supporting revenue growth of 1,900% year on year</h3>

            <div class="serif">
                <p class="bold">We have been the marketing and digital partner for the Conservatory Outlet group for over a decade.</p>
                <p>In this time, the home improvement giant has achieved  exponential growth. Our campaigns deliver thousands of leads for its dealers every month, and it's still growing.</p>
                <a href="#contact" class="btn btn-primary glazing-blue regular pt2 center">Need help generating leads? Get in touch</a>
            </div>
        </div>
    </div>

    <div class="col col-12 md-col-6 bg-top bg-cover wow fadeInUp height-44" data-wow-duration="0.5s" data-wow-delay="0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/co-1.jpg'); visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">
    </div>

</section>

<!-- TWITTER BLOCK -->
<section class="overflow-hidden relative glazing-navy white py3 lg-py3 xl-py4 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s" style="visibility: visible; animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;">
    <div class="container clearfix italic center px1 md-px4">
        <h2 class="h4-responsive center mb2 px2">"Motionlab has been our digital partner for over a decade now. Together, we've grown the Conservatory Outlet from a regional supplier of windows, doors and conservatories to a national retail group with an annual turnover of over £40m."</h2>
        <span>Karen Clough, UK Marketing Manager</span>
    </div>
</section>

<!-- IMAGE BLOCK WITH CENTERED CONTENT -->
<div class="height-30 sm-height-40 md-height-50 lg-full-height mb0 bg-cover bg-center wow fadeIn height-override md-bg-afixed" id="solidor" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/solidor_header.jpg'); background-size: cover;">
    <div class="bg-darken-4 full-h overflow-hidden">

        <div class="table full-h">
            <div class="table-cell center">
                <div class="container px2">
                    <h2 class="mb1 ls-n2 regular h1-responsive mw-50 mx-auto white landing-page-title">
                        Solidor
                    </h2>
                    <p class="white lighten-6 mw-28 mx-auto xl-px5 px5 ls-3 h3">Solidor had a simple ambition, to be the biggest door company in the UK.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- 3 Column Image -->
<section class="overflow-hidden clearfix mx-auto wow fadeIn" style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="0.5s" data-wow-duration="1s">
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-18 bg-center flex flex-center glazing-green">

        <div class="counter counter-right white border border-white glazing-green center" id="counter-7" data-count="45" data-duration="2000"><p class="block mt4 mb0"><span>0</span>%</p><p class="h4 px2 standard">site <br/>visits up</p></div>

    </div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-18 bg-center flex flex-center glazing-green">

        <div class="counter white border border-white glazing-green center" id="counter-8" data-count="52" data-duration="6000"><p class="block mt4 mb0"><span>0</span>%</p><p class="h4 px2 standard">organic <br/>traffic up</p></div>

    </div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-18 bg-center flex flex-center glazing-green">

        <div class="counter counter-left white border border-white glazing-green center" id="counter-9" data-count="82" data-duration="4000"><p class="block mt4 mb0"><span>0</span>%</p><p class="h4 px2 standard">door designer <br/>usage up</p></div>

    </div>
</section>

<!-- 3 Column Image -->
<section class="overflow-hidden clearfix mx-auto wow fadeIn" style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="0.5s" data-wow-duration="1s">
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-35 bg-center" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/so-12.jpg'); visibility: visible;"></div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-35 bg-top" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/so-3.jpg'); visibility: visible;"></div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-35 bg-top" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/so-13.jpg'); visibility: visible;"></div>
</section>

<section class="overflow-hidden clearfix mx-auto wow fadeIn" style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn; visibility: visible;" data-wow-delay="0.5s" data-wow-duration="1s">

    <div class="col col-12 md-col-6 bg-white wow fadeInUp height-auto md-height-36 lg-height-51 flex flex-center p3 md-p5" data-wow-duration="0.5s" data-wow-delay="0" style="visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">
        <div class="black md-p4">
            <h3 class="h2-responsive mt0 mb3" style="font-size: 2.2em">Helping build a £28m brand over 6 years</h3>
            <div class="serif">
                <p class="bold">Our brand building and lead generation strategy has helped make Solidor No.1 for composite doors in the UK.</p>
                <p>In 2017, we helped double the value of the business, increasing web visits by 95% and positioning Solidor as a market leader.</p>
                <a href="#contact" class="btn btn-primary glazing-green regular pt2 center">Need help generating leads? Get in touch</a>
            </div>
        </div>
    </div>

    <div class="col col-12 md-col-6 bg-top bg-cover wow fadeInUp height-auto md-height-36 lg-height-51" data-wow-duration="0.5s" data-wow-delay="0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/so-0.jpg'); visibility: visible;" >
        <div class="block height-auto md-height-30 lg-height-30 table"></div>
    </div>

</section>

<!-- 2 Col Grid -->
<section class="overflow-hidden clearfix mx-auto wow fadeIn" style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="0.5s" data-wow-duration="1s">

    <div class="col col-12 md-col-6 bg-center bg-cover wow fadeInUp height-48" data-wow-duration="0.5s" data-wow-delay="0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/so-9.jpg'); visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">
        <div class="p2">
            <div class="block height-15 md-height-20 lg-height-33 table">
            </div>
        </div>
    </div>

    <div class="col col-12 md-col-6 bg-center glazing-grey bg-cover wow fadeInUp height-48" data-wow-duration="0.5s" data-wow-delay="0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/so-10.jpg'); visibility: visible; background-repeat: no-repeat; animation-duration: 0.5s; animation-name: fadeInUp;">
        <div class="p2">
            <div class="block height-15 md-height-20 lg-height-33 table">
            </div>
        </div>
    </div>

</section>

<!-- TWITTER BLOCK -->
<section class="overflow-hidden relative glazing-grey white py3 lg-py3 xl-py4 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s" style="visibility: visible; animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;">
    <div class="container clearfix italic center px1 md-px4">
        <h2 class="h4-responsive center mb2 px2">"Since working with Motionlab we have seen a dramatic increase in the brand perception of our business, the amount of retail enquiries and huge growth of our National installer network."</h2>
        <span>Gareth Mobley, Solidor</span>
    </div>
</section>

<!-- IMAGE BLOCK WITH CENTERED CONTENT -->
<div class="height-30 sm-height-40 md-height-50 lg-full-height mb0 bg-cover bg-center wow fadeIn height-override md-bg-afixed" id="residencecollection" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/residence_header_home.jpg'); background-size: cover;">
    <div class="bg-darken-4 full-h overflow-hidden">

        <div class="table full-h">
            <div class="table-cell center">
                <div class="container px2">
                    <h2 class="mb1 ls-n2 regular h1-responsive mw-50 mx-auto white landing-page-title">Residence Collection</h2>
                    <p class="white lighten-6 mw-28 mx-auto xl-px5 px5 ls-3 h3">Maximising on and offline exposure of a ground-breaking suite of flush sash windows.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- 3 Column Image -->
<section class="overflow-hidden clearfix mx-auto wow fadeIn" style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="0.5s" data-wow-duration="1s">
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-18 bg-center flex flex-center glazing-gold">

        <div class="counter counter-right white glazing-gold border border-white center" id="counter-10" data-count="48" data-duration="3000"><p class="block mt4 mb0"><span>0</span>%</p><p class="h4 px2 standard">increase in <br/>site visitors</p></div>

    </div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-18 bg-center flex flex-center glazing-gold">

        <div class="counter white glazing-gold border border-white center" id="counter-11" data-count="20" data-duration="3000"><p class="block mt4 mb0"><span>0</span>%</p><p class="h4 px2 standard">rise in brochure<br/>downloads</p></div>

    </div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-18 bg-center flex flex-center glazing-gold">

        <div class="counter counter-left white glazing-gold border border-white center" id="counter-12" data-count="47" data-duration="3000"><p class="block mt4 mb0"><span>0</span>%</p><p class="h4 px2 standard">organic <br/> traffic up</p></div>

    </div>
</section>

<!-- 3 Column Image -->
<section class="overflow-hidden clearfix mx-auto wow fadeIn" style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="0.5s" data-wow-duration="1s">
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-37 bg-center bg-center" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/rc-5.jpg'); visibility: visible;"></div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-37 bg-center bg-top"    style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/rc-6.jpg'); visibility: visible;"></div>
    <div class="col col-12 md-col-4 lg-col-4 bg-cover height-37 bg-center bg-top"    style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/rc-7.jpg'); visibility: visible;"></div>
</section>

<section class="overflow-hidden clearfix mx-auto wow fadeIn" style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn; visibility: visible;" data-wow-delay="0.5s" data-wow-duration="1s">

    <div class="col col-12 md-col-6 bg-white wow fadeInUp height-auto md-height-30 lg-height-49 flex flex-center p3 md-p5" data-wow-duration="0.5s" data-wow-delay="0" style="visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">
        <div class="black md-p4">
            <h3 class="h2-responsive mt0 mb3" style="font-size: 2.2em">Increasing site visitors 40% year on year</h3>
            <div class="serif">
                <p class="bold">We’ve helped  educate consumers about the benefits of Residence Collection’s flush sash timber windows.</p>
                <p>Creating demand for this high-end product offering has seen the Gloucestershire firm expand its range from one to three market-leading products.</p>

                <a href="#contact" class="btn btn-primary glazing-gold regular pt2 center">Need help generating leads? Get in touch</a>
            </div>
        </div>
    </div>

    <div class="col col-12 md-col-6 bg-center bg-cover wow fadeInUp || height-auto md-height-30 lg-height-49" data-wow-duration="0.5s" data-wow-delay="0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/rc-4.jpg');"></div>

</section>

<!-- 2 Col Grid -->
<section class="overflow-hidden clearfix mx-auto wow fadeIn" style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="0.5s" data-wow-duration="1s">

    <div class="col col-12 md-col-6 bg-center bg-cover wow fadeInUp height-51" data-wow-duration="0.5s" data-wow-delay="0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/rc-2.jpg'); visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">
        <div class="p2">
            <div class="block height-15 md-height-20 lg-height-30 table">
            </div>
        </div>
    </div>

    <div class="col col-12 md-col-6 bg-center bg-cover wow fadeInUp height-51" data-wow-duration="0.5s" data-wow-delay="0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/rc-3.jpg'); visibility: visible; background-repeat: no-repeat; animation-duration: 0.5s; animation-name: fadeInUp;">
        <div class="p2">
            <div class="block height-15 md-height-20 lg-height-30 table">
            </div>
        </div>
    </div>

</section>

<!-- 2 Column Grid Large Left -->
<section class="overflow-hidden clearfix mx-auto wow fadeIn" style="animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;" data-wow-delay="0.5s" data-wow-duration="1s">

    <div class="col col-12 height-20 md-height-25 lg-height-50 md-col-4 glazing-grey bg-center bg-contain wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/rc-8.png'); background-repeat: no-repeat; visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">
    </div>

    <div class="col col-12 block height-20 md-height-25 lg-height-50 md-col-8 glazing-greylight bg-bottom bg-cover wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/rc-9.png');  visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">
    </div>

</section>

<!-- TWITTER BLOCK -->
<section class="overflow-hidden relative glazing-gold white py3 lg-py3 xl-py4 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s" style="visibility: visible; animation-duration: 1s; animation-delay: 1s; animation-name: fadeIn;">
    <div class="container clearfix italic center px1 md-px4">
        <h2 class="h4-responsive center mb2 px2">"Since developing our new website and lead generation programme with Motionlab we have seen huge increases in traffic, resulting in more leads for our customers and much greater brand awareness."</h2>
        <span>Sarah Hitchings, Residence Collection</span>
    </div>
</section>

<!--  OTHER WORKS -->
<section class="overflow-hidden wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="flex flex-wrap">
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0000.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint=""  rel="group">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0000.jpg" class="height-auto" alt="">
        </a>
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0001.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint=""  rel="group">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0001.jpg" class="height-auto" alt="">
        </a>
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0011.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint=""  rel="group">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0011.jpg" class="height-auto" alt="">
        </a>
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0004.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint=""  rel="group">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0004.jpg" class="height-auto" alt="">
        </a>
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0003.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint=""  rel="group">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0003.jpg" class="height-auto" alt="">
        </a>
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0012.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint=""  rel="group">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0012.jpg" class="height-auto" alt="">
        </a>
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0006.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint=""  rel="group">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0006.jpg" class="height-auto" alt="">
        </a>
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0007.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint=""  rel="group">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0007.jpg" class="height-auto"  alt="">
        </a>
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0008.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint=""  rel="group">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0008.jpg" class="height-auto" alt="">
        </a>
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0009.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint=""  rel="group">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0009.jpg" class="height-auto" alt="">
        </a>
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0010.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint=""  rel="group">
            <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0010.jpg" class="height-auto" alt="">
        </a>
        <a href="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0014.jpg" class="js-magnific col col-4 md-col-3 lg-col-2 relative bg-darken-4-grey overflow-hidden height-8 sm-height-12 md-height-16 lg-height-16" data-dip-tint="" rel="group">
        <img src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/gallery/Glass_Glazing_Blocks_0000s_0014.jpg" class="height-auto" alt="">
        </a>
    </div>
</section>

<!-- CONTENT CENTERD BLOCK -->
<section class="overflow-hidden py2 mt4 lg-py3 xl-py4 mb5 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container px2 xl-px5 clearfix lg-center">
        <h2 class="h2 black bold serif mb2 center">Home improvement clients we have worked with:</h2>

        <div class="flex flex-wrap">
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/AO.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Bison.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Carlisle_Brass.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Clearview.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Conservatory_Outlet.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Discover_Air.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Easigrass.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Eden_Windows.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Epwin.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/FIT_Show.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/GGF.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Liniar.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Mighton.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Mila.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Orion.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Planitherm.jpg"alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Pennine.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/QuickSlide.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Residence_Collection.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Residor.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Saint-Gobain.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Solidor.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Swish.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Swisspacer.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Trend_Transformations.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/TruFrame.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/Vetrotech.jpg" alt="">
            </div>
            <div class="col col-6 md-col-3 lg-col-3 center">
                <img style="max-width: 8rem" src="<?php echo get_template_directory_uri(); ?>/img/casestudy-glazing/logos/WIndow_Ware.jpg" alt="">
            </div>
        </div>

    </div>
    <div id="contact"></div>
</section>

<section class="clearfix py4" style="background: #fafafa">

    <div class="container p2">

        <div class="col-12 center">

            <h3 class="h2 mb2">Fancy generating more leads?</h3>
            <p class="mb3">Please get in touch to discuss how our team <br> will generate more leads and sales for your business.</p>

        </div>

        <div class="col-12 lg-col-6 lg-push-2 wow fadeIn">
            <?php echo do_shortcode('[gravityform id="4" title="false"]'); ?>
        </div>
    </div>

</section>

<!-- PULL FROM ORIGINAL - http://www.motionlab.co.uk/glass-glazing/ -->
<div class="lg-show clearfix">
    <div class="col col-12 md-col-4 bg-center bg-left bg-cover relative" style="background-image: url('http://i0.wp.com/www.motionlab.co.uk/wp-content/uploads/2018/01/GDPR_content_asset_webheader_2048x997.jpg?fit=4267%2C2077');">
        <div class="p2 bg-darken-4-blue" data-dip-tint="">
            <a href="http://www.motionlab.co.uk/blog/are-you-ready-for-gdpr/2018/01/" class="block height-15 md-height-20 lg-height-30 table txt-dec-none front relative">
                <div class="table-cell center  white front ">
                    <h3 class="h1-responsive mx-auto mw-14 front">Are you ready for GDPR?</h3>
                    <p class="h4 mx-auto white ls-2 mw-26 serif" style="opacity:0.8;">With just a few short months to go until the implementation date of 25 May 2018, we’ve compiled our ‘6 point guide’ to everything you need to know about GDPR, what it means for your business and – most importantly – how to get compliant.</p>
                </div>
            </a>
        </div>
    </div>
    <div class="col col-12 md-col-4 bg-center bg-cover relative wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0" style="background-image: url('http://i1.wp.com/www.motionlab.co.uk/wp-content/uploads/2017/07/Blog_Form-Banner.jpg?fit=1934%2C1143'); visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">
        <div class="p2 bg-darken-4-blue" data-dip-tint="">
            <a href="http://www.motionlab.co.uk/blog/website-forms-working-hard-enough-business/2017/07/" class="block height-15 md-height-20 lg-height-30 table txt-dec-none front relative">
                <div class="table-cell center  white ">
                    <h3 class="h1-responsive mx-auto mw-14">Are your website forms working hard enough for your business?</h3>
                    <p class="h4 mx-auto white ls-2 mw-26 serif" style="opacity:0.8;">Find out how to generate more leads for your business.</p>
                </div>
            </a>
        </div>
    </div>
    <div class="col col-12 md-col-4 bg-center bg-cover relative wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0" style="background-image: url('http://i1.wp.com/www.motionlab.co.uk/wp-content/uploads/2017/01/Clearview-Spotlight.jpg?fit=1934%2C1143'); visibility: visible; animation-duration: 0.5s; animation-name: fadeInUp;">
        <div class="p2 bg-darken-4-blue" data-dip-tint="">
            <a href="http://www.motionlab.co.uk/blog/client-spotlight-clearview-home-improvements/2017/05/" class="block height-15 md-height-20 lg-height-30 table txt-dec-none front relative">
                <div class="table-cell center  white ">
                    <h3 class="h1-responsive mx-auto mw-14">Client Spotlight – Clearview Home Improvements</h3>
                    <p class="h4 mx-auto white ls-2 mw-26 serif" style="opacity:0.8;">Driving Traffic and Increasing Brand Awareness.</p>
                </div>
            </a>
        </div>
    </div>
</div>


<div class="wow fadeInUp border-top border-darken-2" data-wow-duration="1s" data-wow-delay="0.5s" style="visibility: visible; animation-duration: 1s; animation-delay: 1s; animation-name: fadeInUp;">
    <div class="py1 bg-darken-1">
        <div class="container center overflow-hidden mt2 p2">
            <p class="h3 black bold serif">Do you have a goal you would like to discuss with Motionlab? &nbsp;&nbsp;<br class="md-hide"></p>
            <span class="inline-block px3 py2 lg-py0">
                    <a href="contact/" class="btn btn-primary bg-black white px3 ls-n1">Get In Touch</a>
                </span>

        </div>
    </div>
</div>
</div>
