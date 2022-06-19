<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mortgage-experience
 */

$contactno = get_field('contact_number', 'option');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1 , maximum-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <base href="/">
    <?php wp_head(); ?>

    <!-- Facebook Verification Code -->
    <meta name="facebook-domain-verification" content="mqtx9afq6z1bkv23wemi4lqfox2qv8" />

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '955267185116525');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=955267185116525&ev=PageView&noscript=1"/>
    </noscript>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-TNW95NJ');</script>
    <!-- End Google Tag Manager -->
    <script src="https://cdn-eu.pagesense.io/js/motionlabmarketing/1a41a562f80d4bcdbc4ff043f6f3c71d.js"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<header class="header-area-wrapper header-four transparent-header sticky-header pt-3">

    <div class="container">

        <div class="position-relative d-flex justify-content-between justify-content-lg-start align-items-center">
            <div class="header-left-wrapper col-lg-3 col-sm-12">
                <!-- Start Logo Area Wrap -->
                <a href="/" class="logo-wrap d-block">
                    <img src="<?php echo get_template_directory_uri();?>/dist/img/ME-Logo.svg" alt="Mortgage Experience" />
                    <img class="sticky-logo" src="<?php echo get_template_directory_uri();?>/dist/img/ME-Logo.svg" alt="Mortgage Experience" />

                </a>
                <!-- End Logo Area Wrap -->
            </div>

            <!-- Start Main Navigation Wrap -->
            <div class="header-right-wrapper col-lg-9">
                <div class="header-right-area d-flex justify-content-end align-items-right mobilehide">
                    <p>Talk to one of our mortgage experts on <a href="tel:<?php the_field('contact_number', 'option'); ?>"><?php the_field('contact_number', 'option'); ?></a> </p>
                </div>
            </div>
            <!-- End Main Navigation Wrap -->

            <div class="header-right-sub-area d-flex align-items-center">
                <div id="ChangeToggle" class="off-canvas-area-wrap d-flex d-lg-block">
                    <!-- Mobile Responsive Menu Button -->
                    <button class="mobile-menu text-black d-lg-none ml-md-30 ml-sm-30"><i class="fa fa-bars"></i>  </button>
                    <!-- Off Canvas Close Icon -->
                    <button id="navbar-close" class="hidden btn-close-mobile d-lg-none ml-md-30 ml-sm-30" data-tippy-content="Close" data-tippy-placement="right"><i class="fas fa-times"></i> </button>
                </div>
            </div>

        </div>
    </div>
</header>

<div class="container-fluid top-header-mobile">
    <h3><a>Talk to one of our mortgage <br>experts on <a href="tel:<?php the_field('contact_number', 'option'); ?>"><?php the_field('contact_number', 'option'); ?></a></h3>
</div>

