<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mortgage-experience
 */

?>

	<footer class="advisorsFooter animatedDiv data-aos_fade-up  data-aos-delay_100 data-aos-duration_400">
<div class="container">
    <div class="row">
        <div class="col-lg-1">
            <h3>Trust</h3>
        </div>
        <div class="col-lg-6 me--logo">
            <img src="<?php echo get_template_directory_uri();?>/dist/img/ME-Logo_white.svg"/>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-6">
            <h3 class="h4">Talk to one of our Mortgage Experts on <a href="tel:<?php the_field('contact_number', 'option'); ?>"><?php the_field('contact_number', 'option'); ?></a></h3>
            <p>Mortgage Experience Limited is an appointed representative of HL Partnership Limited, which is authorised and regulated by the Financial Conduct Authority.</p>
<p>&#160;</p>
            <a href="https://www.checkmyfile.com/credit-report.htm?ref=andymorrison&cbap=1" target="_blank"> <img src="/wp-content/uploads/2021/12/CheckMyFile_logo.png" alt="check My File" width="45%"/></a>
            <p>Download your Credit Report </p>
        </div>

        <div class="col-lg-3 offset-lg-3  justify-content-end">
            <p class="d-flex "><b>Connect with us</b></p>
            <ul class="footer-social-menu ">
                <li><a href="<?php the_field('linkedin_url', 'option'); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                <li><a href="<?php the_field('facebook_url', 'option'); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="<?php the_field('twitter_url', 'option'); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
            </ul>
        </div>

    </div>




</div>


	</footer><!-- end footer -->


<div class="copyright-statement">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <?php the_field('guidance_message', 'option'); ?>
            </div>

            <div class="col-md-5 offset-md-2">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer-legal',
                        'container'       => 'ul',
                        'container_id'    => '',
                        'depth'           => 3,
                        'menu_class'      => 'footer-menu-legal nav d-flex flex-row justify-content-end',
                        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    )
                );
                ?>

                <p class="copyrightMessage">Copyright  <script>  document.write(new Date().getFullYear()+' ');</script> Mortgage Experience. All Right Reserved. </p>
                <p class="copyrightMessage">Site design by <a style="color:#fff;" href="https://www.amplifysales.co.uk">Amplify Sales</a> </p>
                <p class="copyrightMessage"><a style="color:#fff;" href="https://www.amplifysales.co.uk">Wordpress Support</a>  by Amplify WordPress </p>
                <p style="text-align: right;">Mortgage Experience Limited is registered in England and Wales. Company No. 10428355. Registered Office: Renaissance House, 4 East Terrace Business Park, Euxton Lane, Chorley, PR7 6TB</p>
            </div>

        </div>
    </div>
</div>




<!--== Start Off Canvas Area Wrapper ==-->
<aside class="off-canvas-responsive-menu">
    <!-- Off Canvas Overlay -->
    <div class="off-canvas-overlay"></div>

    <!-- Start Off Canvas Content Area -->
    <!-- Start Off Canvas Content Area -->
    <div class="off-canvas-content-wrap">
        <div class="off-canvas-content">

            <div class="trustPilot">
                <!-- TrustBox widget - Micro Review Count -->
                <div class="trustpilot-widget" data-locale="en-GB" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="59d644180000ff0005ace17e" data-style-height="24px" data-style-width="100%" data-theme="light" style="position: relative;"><iframe style="position: relative; height: 24px; width: 100%; border-style: none; display: block; overflow: hidden;" title="Customer reviews powered by Trustpilot" src="https://widget.trustpilot.com/trustboxes/5419b6a8b0d04a076446a9ad/index.html?templateId=5419b6a8b0d04a076446a9ad&amp;businessunitId=59d644180000ff0005ace17e#locale=en-GB&amp;styleHeight=24px&amp;styleWidth=100%25&amp;theme=light"></iframe></div>
                <!-- End TrustBox widget -->
            </div>

            <p class="nav-call d-flex justify-content-center"><i class="fas fa-mobile-alt"></i> Call: <a href="tel:<?php the_field('contact_number', 'option'); ?>"><?php the_field('contact_number', 'option'); ?></a> </p>

                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'header-main-menu-mobile',
                        'container'       => 'ul',
                        'container_id'    => '',
                        'depth'           => 3,
                        'menu_class'      => 'nav d-flex flex-column',
                        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    )
                );
                ?>
            <div class="navigation-buttons">
           <p class="d-flex justify-content-center"> <a class="btn button-primary" href="/get-started/">New Mortgage</a></p>
            <p  class="d-flex justify-content-center"><a class="btn button-primary " href="/get-started/"> Remortgage</a></p>
            </div>

            <p class="d-flex justify-content-center"><b>Connect with us</b></p>
            <ul class="header-social-menu">
                <li><a href="<?php the_field('linkedin_url', 'option'); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                <li><a href="<?php the_field('facebook_url', 'option'); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="<?php the_field('twitter_url', 'option'); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
            </ul>



        </div>

    </div>
    <!-- End Off Canvas Content Area -->
</aside>
<!--== End Off Canvas Area Wrapper ==-->

<?php wp_footer(); ?>
<script async src="<?php echo get_template_directory_uri();?>/dist/js/custom.min.js"></script>
<script async src="<?php echo get_template_directory_uri();?>/dist/js/calculators.min.js"></script>


</body>
</html>
