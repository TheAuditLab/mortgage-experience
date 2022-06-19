<?php

require_once(get_template_directory() . "/libs/client/base.php");

/**
 * Class theLab
 * Handles the displaying of the 404 page,
 * as well as any additional functionality
 */
class theLab extends CL_Base {

    /**
     * Construct for the controller
     *
     * @param null $body
     */
    public function __construct($body = null) {
       
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

<section id="" class="height-20 sm-height-25 md-height-25 lg-height-35 wow fadeIn bg-grey flex items-center justify-center" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/thelab/thelab-banner.jpg); background-position: 50%; background-size: cover; background-attachment: inherit;">

   <div class="bg-darken-4 full-h overflow-hidden width-100">

      <div class="table full-h width-100">
            <div class="table-cell center">
               <div class="container px2">
                  <h1 class="mb1 ls-n2 regular h00-responsive mw-20 mx-auto white">The Lab</h1>
                                                
                  <h3 class="h5 md-h3 regular mx-auto mw-50 wow fadeInUp white lh-3 lg-show" style="line-height: 1.8; visibility: visible; animation-name: fadeInUp;">
                     <div class="overflow-hidden ls-3" style="opacity:0.8;line-height: 1.8;">We live in a complicated, unpredictable world where change is a daily occurrence. In the world of marketing and human interaction, it has become a game of art and maths, predicting, analysing and testing in an attempt to drive leads and deliver capital gain for business.</div>
                  </h3>

               </div>
            </div>
      </div>

   </div>

</section>

<section id="" class="clearfix mx-auto wow fadeIn pb4">

   <div class="container p2 mt2 mb2 md-mt4 md-mb4 lg-py4 ls-4">

      <div class="clearfix mxn2 center">

         <div class="darken-4 xl-px3 ls-3 h4 md-h3 px3 md-hide">
            <p>We live in a complicated, unpredictable world where change is a daily occurrence. In the world of marketing and human interaction, it has become a game of art and maths, predicting, analysing and testing in an attempt to drive leads and deliver capital gain for business.</p>
         </div>

         <div class="darken-4 xl-px3 ls-3 h4 md-h3 px3">
            <p>Experienced marketers are in a continual learning cycle, educating themselves on the latest tools to streamline processes and refine their data. <strong>The Lab</strong>, in conjunction with Motionlab, has been developed to bring together like-minded individuals who have a passion for learning and self-development, to collaboratively tackle the issues faced in the world of creative marketing and human interface design.</p>
        </div>

        <div class="italic mt4 mb4 h4 md-h2 mx-auto mw-60 px3" style="max-width: 60%;">
            <p>"Our mission is to be a source of knowledge for companies and individuals. <strong>The Lab</strong> will be a learning and resource hub for those passionate about being at the forefront of marketing innovation in their chosen field."</p>
        </div>

        <div class="darken-4 xl-px3 ls-3 h4 md-h3 px3">
            <p><strong>The Lab</strong> will launch early 2019, running a series of expert 'open table' sessions, <br/> e-learning modules, events and seminars.</p>
        </div>

      </div>

   </div>

</section>

<?php if (isset($hidden) && $hidden === false): ?>
<section id="" class="clearfix mx-auto wow fadeIn">

   <div class="container p2 lg-py4 ls-4">

      <div class="clearfix mxn2 lg-py2 xl-py3 center">
         <h2 class="h1-responsive regular lg-mw-24 lg-mx-auto">Our Upcoming Sessions at 'The Lab'</h2>

         <div class="darken-4 xl-px3 ls-3">
            <p>Check out our upcoming sessions with our team of specialists.</p>
        </div>

      </div>

      <div class="">
      
         <div class="col col-6 md-col-4 p2">
            <div class="p2 js-match-height" style="border-bottom: 3px solid rgba(48, 48, 48, 1);">
               <h3>Lorem ipsum dolor sit amet</h3>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
               <p class="mb0"><strong>Author:</strong> 12 Jan 2018</p>
               <p class=""><strong>Hosted:</strong> 12 Jan 2018</p>
            </div>
         </div>
         <div class="col col-6 md-col-4 p2">
            <div class="p2 js-match-height" style="border-bottom: 3px solid rgba(48, 48, 48, 1);">
               <h3>Lorem ipsum dolor sit amet</h3>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
               <p class="mb0"><strong>Author:</strong> 12 Jan 2018</p>
               <p class=""><strong>Hosted:</strong> 12 Jan 2018</p>
            </div>
         </div>
         <div class="col col-6 md-col-4 p2">
            <div class="p2 js-match-height" style="border-bottom: 3px solid rgba(48, 48, 48, 1);">
               <h3>Lorem ipsum dolor sit amet</h3>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
               <p class="mb0"><strong>Author:</strong> 12 Jan 2018</p>
               <p class=""><strong>Hosted:</strong> 12 Jan 2018</p>
            </div>
         </div>
         <div class="col col-6 md-col-4 p2">
            <div class="p2 js-match-height" style="border-bottom: 3px solid rgba(48, 48, 48, 1);">
               <h3>Lorem ipsum dolor sit amet</h3>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
               <p class="mb0"><strong>Author:</strong> 12 Jan 2018</p>
               <p class=""><strong>Hosted:</strong> 12 Jan 2018</p>
            </div>
         </div>
         <div class="col col-6 md-col-4 p2">
            <div class="p2 js-match-height" style="border-bottom: 3px solid rgba(48, 48, 48, 1);">
               <h3>Lorem ipsum dolor sit amet</h3>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
               <p class="mb0"><strong>Author:</strong> 12 Jan 2018</p>
               <p class=""><strong>Hosted:</strong> 12 Jan 2018</p>
            </div>
         </div>

      
      </div>

   </div>

</section>
<?php endif; ?>

<?php if (isset($hidden) && $hidden === false): ?>
<section id="" class="mt4">

   <div class="p2 lg-py4 ls-4 bg-blue">

      <div class="container flex items-center justify-between">

         <h2 class="m0 p0 white bold">Interested in a session?</h2>
         <a href="#" class="bg-white py1 px2 text-decoration-none hover-text-decoration-none rounded">Register Intrest Now</a>

      </div>

   </div> 

</section>
<?php endif; ?>

<?php if (isset($hidden) && $hidden === false): ?>
<section id="" class="clearfix mx-auto wow fadeIn">

   <div class="container p2 lg-py4 ls-4 mb4">

      <div class="clearfix mxn2 lg-py2 xl-py3 center">
         <h2 class="h1-responsive regular lg-mw-24 lg-mx-auto">Why attend?</h2>

         <div class="darken-4 xl-px3 ls-3">
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio.</p>
        </div>

      </div>

      <div class="clearfix">
      
         <div class="col col-6 md-col-3 p2">
            <div class="p2">
               
               <span class="fa-stack fa-lg blue mb2" style="font-size: 12px;">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-check fa-stack-1x fa-inverse"></i>
               </span>

               <p class="bold">Lorem ipsum dolor sit amet</p>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
            </div>
         </div>
         <div class="col col-6 md-col-3 p2">
            <div class="p2">
               <span class="fa-stack fa-lg blue mb2" style="font-size: 12px;">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-check fa-stack-1x fa-inverse"></i>
               </span>

               <p class="bold">Lorem ipsum dolor sit amet</p>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
            </div>
         </div>
         <div class="col col-6 md-col-3 p2">
            <div class="p2">
               <span class="fa-stack fa-lg blue mb2" style="font-size: 12px;">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-check fa-stack-1x fa-inverse"></i>
               </span>

               <p class="bold">Lorem ipsum dolor sit amet</p>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
            </div>
         </div>
         <div class="col col-6 md-col-3 p2">
            <div class="p2">
               <span class="fa-stack fa-lg blue mb2" style="font-size: 12px;">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-check fa-stack-1x fa-inverse"></i>
               </span>

               <p class="bold">Lorem ipsum dolor sit amet</p>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
            </div>
         </div>
         <div class="col col-6 md-col-3 p2">
            <div class="p2">
               <span class="fa-stack fa-lg blue mb2" style="font-size: 12px;">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-check fa-stack-1x fa-inverse"></i>
               </span>

               <p class="bold">Lorem ipsum dolor sit amet</p>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
            </div>
         </div>

         <div class="col col-6 md-col-3 p2">
            <div class="p2">
               <span class="fa-stack fa-lg blue mb2" style="font-size: 12px;">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-check fa-stack-1x fa-inverse"></i>
               </span>

               <p class="bold">Lorem ipsum dolor sit amet</p>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
            </div>
         </div>

         <div class="col col-6 md-col-3 p2">
            <div class="p2">
               <span class="fa-stack fa-lg blue mb2" style="font-size: 12px;">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-check fa-stack-1x fa-inverse"></i>
               </span>

               <p class="bold">Lorem ipsum dolor sit amet</p>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. </p>
            </div>
         </div>

      
      </div>

   </div>

</section>
<?php endif; ?>

<section id="" class="clearfix mx-auto wow fadeIn pb4 bg-grey">

   <div class="container p2 mb4 lg-py4 ls-4">

      <div class="clearfix mxn2 lg-py2 xl-py3 center px3">
         <h2 class="h1-responsive regular lg-mw-24 lg-mx-auto">Register Your Interest Today</h2>

         <div class="darken-4 xl-px3 ls-3">
            <p>If you would like to be kept up to date with what we have planned, please fill in the form below.</p>
        </div>

      </div>

      <div class="signup-form">

         <?php echo do_shortcode('[gravityform id="5" title="false" description="false"]'); ?>

      </div>

   </div>

</section>

<style>
   h1 {font-size: 3rem !important;}
   @media (min-width:48rem){
      h1 {font-size: 5rem !important;}
      .md-hide{display:none !important;}
      .md-h2{font-size:1.5rem !important}
      .md-h3{font-size:1.25rem !important}

      select:not([multiple]) {
         height: 2.25rem !important;
      }
      #input_5_24  input {
         width: 1rem !important;
         height: 28px  !important;
      }
      #field_5_21 li {
         width: auto !important;
      }
   }
   select:not([multiple]) {
    height: 2.75rem !important;
   }
   #input_5_24  input {
      width: 45px;
      height: 30px;
   }
   #input_5_24 .gchoice_5_24_1 {
      align-items: initial;
   }
   #field_5_21 li {
      width: 100%;
   }
</style>


<script>
    $(document).ready(function(){
       $("gform_submit_button_5").on('click', function() {
           if (typeof __gaTracker === 'function') {
               __gaTracker('send', 'event', {
                   eventCategory: 'The Lab Sign Up',
                   eventAction: 'Sign Up',
                   eventLabel: 'Lab Sign Ups'
               });
           }
       });
    });
</script>
