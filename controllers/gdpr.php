<?php
require_once(get_template_directory() . "/libs/client/base.php");

/**
 * Class pagegdpr
 * Handles the displaying of the 404 page,
 * as well as any additional functionality
 */
class pagegdpr extends CL_Base {
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

<div class="bg-cyan-magenta-gradient relative">
   <div class="cloud-container absolute top-0 right-0 left-0 bottom-0 overflow-hidden">
      <div class="x1">
         <div class="cloud"></div>
      </div>
      <div class="x2">
         <div class="cloud"></div>
      </div>
      <div class="x3">
         <div class="cloud"></div>
      </div>
      <div class="x4">
         <div class="cloud"></div>
      </div>
      <div class="x5">
         <div class="cloud"></div>
      </div>
   </div>
   <div class="px3 sm-px5 white clearfix">
      <div class="relative z2 flex">
         <h1 class="left display-none">6 points you need to know about gdpr</h1>
         <div class="relative col-12 sm-col-6 sign-container wow fadeInLeft" data-wow-duration="1s">
            <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-six.svg" alt="" class="col-6 sm-col-4 swinging-sign" style="top:-50%;">
            <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-title.svg" alt="" class="col-5 sm-col-4" style="top:30%; left:30%; z-index:-1;">
         </div>
         <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-computer.svg" alt="" class="absolute col-5 sm-show wow fadeInRight" style="visibility:hidden; left:50%; top:10%;">
      </div>
   </div>
   <div class="bg-transparent-white absolute bottom-0 left-0 right-0 height-30 z1"></div>
</div>

<div class="container px2 relative timeline">
   <div class="timeline-bar bg-black"></div>
   <ul class="list-reset clearfix">
      <li class="sm-col-6 mb4 wow fadeInLeft" data-wow-duration="1s" style="visibility:hidden;">
         <div class="relative">
            <h2 class="gray h00 m0 bold">01</h2>
            <h3 class="blue mt0">What is GDPR?</h3>
            <p>The <strong>General Data Protection Regulation</strong> (GDPR) is the EU’s new data protection legislation. It is designed to give people control of their personal data and simplify the regulatory environment for international business by unifying the regulation throughout the EU.</p>
            <p>Currently, the UK abides by the Data Protection Act 1998, but this will be superseded by the new legislation which will introduce tougher fines for noncompliance and breaches of GDPR.</p>
         </div>
      </li>
      <li class="sm-col-6 mb4 wow fadeInRight" data-wow-duration="1s" style="visibility:hidden;">
         <figure class="m0 sm-right mw-15 || calendar">
            <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-02.svg" alt="" class="col-12">
         </figure>
         <div class="relative">
            <h2 class="gray h00 m0 bold">02</h2>
            <h3 class="blue mt0">When will it happen?</h3>
            <p>GDPR is a regulation and not a directive which means it will be applied automatically, without the need for a new legislation to be drawn up, when it comes into force on 25th May 2018.</p>
            <p>GDPR isn’t new. It actually came into force on 24th May 2016, but businesses have been given until the 25th May to comply. Even though the UK is set to leave the EU, businesses will still have to abide by GDPR.</p>
         </div>
      </li>
      <li class="sm-col-6 mb4 wow fadeInLeft" data-wow-duration="1s" style="visibility:hidden;">
         <figure class="m0 box-sizing sm-mr5" style="margin-bottom:-5rem;">
            <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-03.svg" alt="">
         </figure>
         <div class="relative">
            <h2 class="gray h00 m0 bold">03</h2>
            <h3 class="blue mt0">What does it mean to my business?</h3>
            <p>Whether you’re a ‘controller’ or ‘processor’ of data, you need to be GDPR compliant. GDPR applies to any business that stores or handles data belonging to EU residents. Whether it’s an email list you’ve been marketing to, postal addresses of your customers, data you’re capturing via web forms, data collection at events or a prospecting list you’ve purchased - GDPR will apply to you.</p>
            <p>It is your responsibility to make sure that any data your business holds has been acquired lawfully and within the GDPR guidelines. All data must have been obtained with consent from the individual whose data you hold and any unsubscribe emails must not receive any further communication from you.</p>
         </div>
      </li>
      <li class="sm-col-6 mb4 wow fadeInRight" data-wow-duration="1s" style="visibility:hidden;">
         <figure class="m0 box-sizing sm-ml5" style="margin-bottom:-5rem;">
            <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-04.svg" alt="">
         </figure>
         <div class="relative">
            <h2 class="gray h00 m0 bold">04</h2>
            <h3 class="blue mt0">What do I need to do?</h3>
            <p>Firstly, don’t panic. Then draw up a list of all the data you hold. Ask yourself if you have a genuine need to hold all of this data. Asses if you can prove that you have acquired any data you hold with consent, and if you have a specific purpose for holding this data. If you’ve got old data for customers you haven’t contacted in years, now is the time to get rid of it.</p>
            <p>Motionlab takes a firm stance on buying data - it’s not something that we advocate. If you’ve bought a list in the past, we would recommend that this is deleted, unless you can prove that it was lawfully acquired by your supplier.</p>
            <p>Going forward, you will need to put measures in place to ensure that you can very clearly obtain an individual’s consent to collect and store their data, as well as explaining how you intend to use it - from the type of contact (email, phone, post) through to the frequency and nature of the contact you intend to have with them.</p>
            <div class="md-col-8">
               <figure class="m0 box-sizing mb3">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-04b.svg" alt="">
               </figure>
               <p>
                  This can be done by introducing additional opt in fields to any web forms that you use to collate data or by creating opt in and data use boxes to any printed data collection material, you can contact any active email subscribers and ask them to re-opt in.
               </p>
            </div>
         </div>
      </li>
      <li class="sm-col-6 mb4 wow fadeInLeft" data-wow-duration="1s" style="visibility:hidden;">
         <div class="relative">
            <div class="flex">
               <div class="">
                  <h2 class="gray h00 m0 bold">05</h2>
                  <h3 class="blue mt0">What will happen if I don't comply?</h3>
               </div>
               <figure class="m0 box-sizing" style="margin-bottom:-5rem;">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-05a.svg" alt="" class="col-12">
               </figure>
            </div>
            <div class="clearfix">
               <figure class="m0 ml2 box-sizing mw-12 col-12 right md-show">
                  <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-05b.svg" alt="" class="col-12">
               </figure>
               <p>There have already been some hefty fines for companies who have misused data in the UK. But like with many laws, it’s all relative. Whilst small businesses have to comply, the fines for non compliance will be far lower than large corporations.<br /><br />
               The ICO (Information Commissioner’s Office), which is the UK’s independent authority set up to uphold information rights in the public interest, will be enforcing GDPR in the UK - but it’s likely they’ll be focussing on the country’s biggest businesses in the first instance and will rely on internal resource of just 300 officers to implement GDPR.</p>
               <p>Businesses that cannot show they have the right measures in place will be liable to pay fines. And if you don’t comply and contact someone unlawfully they are well within their rights to report you to the ICO, who will be obliged to follow up and investigate any complaint they receive.</p>
               <p>So it’s not just the monetary risk that comes with not complying, companies could face a hit on their reputation when their non compliance is publicised.</p>
            </div>
         </div>
      </li>
      <li class="sm-col-12 relative z1 mt5 || last">
         <div class="relative wow fadeInUp" data-wow-duration="1s" style="visibility:hidden;">
            <div class="sm-center">
               <h2 class="gray h00 m0 bold">06</h2>
               <div class="sm-show ">
                  <h3 class="blue mt0 mb3 || banner">How can <strong>Motionlab</strong> help me?</h3>
               </div>
            </div>
            <h3 class="blue mt0 sm-hide">How can <strong>Motionlab</strong> help me?</h3>
            <div class="mxn2 flex flex-wrap">
               <div class="col col-12 sm-col-6 md-col-4 px2 left">
                  <figure class="m0 box-sizing mw-6 col-12">
                     <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-06a.svg" alt="" class="col-12">
                  </figure>
                  <h4 class="green mt0">Data Opt-in</h4>
                  <p>We can ensure all your website forms and registration cover the appropriate opt-in to ensure you’re compliant and able to broadcast future marketing and sales communications.</p>
               </div>
               <div class="col col-12 sm-col-6 md-col-4 px2 left">
                  <figure class="m0 box-sizing mw-6 col-12">
                     <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-06b.svg" alt="" class="col-12">
                  </figure>
                  <h4 class="green mt0">Opt-in Types</h4>
                  <p>Don’t just give the user the option to opt-in to all communications, provide them with a choice. Motionlab will help you to develop an opt-in process which provides the user with communications options such as by email, by phone, by post, by SMS. Furthermore we will allow a recipient to state what products or services they wish to hear about.</p>
               </div>
               <div class="col col-12 sm-col-6 md-col-4 px2 left">
                  <figure class="m0 box-sizing mw-6 col-12">
                     <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-06c.svg" alt="" class="col-12">
                  </figure>
                  <h4 class="green mt0">Double Opt-in</h4>
                  <p>To ensure your data collection is compliant Motionlab is able to implement double opt-in which confirms that the person who entered their email address actually wants to subscribe to future communications.</p>
               </div>
               <div class="col col-12 sm-col-6 md-col-4 px2 left">
                  <figure class="m0 box-sizing mw-6 col-12">
                     <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-06d.svg" alt="" class="col-12">
                  </figure>
                  <h4 class="green mt0">Data Cleanse</h4>
                  <p>Data Cleansing (or Data Scrubbing) is a key action when complying with the GDPR. Motionlab is able to support you with cleansing your data to identify and then removing or amending any data within your database which incorrect, incomplete, duplicated or unnecessary to hold.</p>
               </div>
               <div class="col col-12 sm-col-6 md-col-4 px2 left">
                  <figure class="m0 box-sizing mw-6 col-12">
                     <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-06e.svg" alt="" class="col-12">
                  </figure>
                  <h4 class="green mt0">Subject Access Form</h4>
                  <p>Subject access is another compliance point which your business will need to adhere to. This essentially allows a user to request all information which you hold on them. Motionlab is able to develop a dedicated landing page which allows a user to request a report on the data which you hold on them, these requests have to be actioned within 30 days.</p>
               </div>
               <div class="col col-12 sm-col-6 md-col-4 px2 left">
                  <figure class="m0 box-sizing mw-6 col-12">
                     <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-06f.svg" alt="" class="col-12">
                  </figure>
                  <h4 class="green mt0">Maintenance</h4>
                  <p>With fines being possible for any data losses it’s incredibly important for any business that their web applications and servers are safe and secure, therefore fully up to date with any security patches put in place. Motionlab is able to maintain your website if support is required.</p>
               </div>
               <div class="col col-12 sm-col-6 md-col-4 px2 left">
                  <figure class="m0 box-sizing mw-6 col-12">
                     <img src="<?php echo get_template_directory_uri(); ?>/img/gdpr-06g.svg" alt="" class="col-12">
                  </figure>
                  <h4 class="green mt0">SSL</h4>
                  <p>Implementation of an SSL into any website is a must in today’s online world as it adds an extra level of trust and security. An SSL provides data security, site verification and verification of information.</p>
               </div>
            </div>
         </div>
      </li>
   </ul>
</div>

<div class="bg-cyan-magenta-gradient py5 relative z2">
   <div class="bg-white-transparent absolute top-0 left-0 right-0 bottom-0 z1"></div>
   <div class="p5 white center relative z2">
      <a href="/contact" class="btn border border-white rounded h2 py3 px5" style="border-width:2px;">Get in touch.</a>
   </div>
</div>
