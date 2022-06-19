<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package mortgage-experience
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mortgage_experience_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'mortgage_experience_body_classes' );

function my_acf_format_value( $value, $post_id, $field ) {

    return esc_attr($value);

}

add_filter('acf/format_value/type=url', 'my_acf_format_value', 10, 3);

/** * Completely Remove jQuery From WordPress Admin Dashboard */
add_action('wp_enqueue_scripts', 'no_more_jquery');
function no_more_jquery(){
    wp_deregister_script('jquery');
}



/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function mortgage_experience_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'mortgage_experience_pingback_header' );

function allow_onclick_content() {
    global $allowedposttags, $allowedtags;
    $newattribute = "onclick";

    $allowedposttags["a"][$newattribute] = true;
    $allowedtags["a"][$newattribute] = true; //unnecessary?
}
add_action( 'init', 'allow_onclick_content' );

function register_my_menus() {
    register_nav_menus(
        array(
            'header-main-menu-desktop' => __( 'Header Main Menu Desktop' ),
            'header-main-menu-mobile' => __( 'Header Main Menu Mobile' ),
            'top-header-menu' => __( 'Top header Menu' ),
            'footer-main-1' => __( 'Footer - Main 1' ),
            'footer-main-2' => __( 'Footer - Main 2' ),
            'footer-legal' => __( 'Footer - Legal' )
        )
    );
}
add_action( 'init', 'register_my_menus' );




function acf_page_slider() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'page-slider',
            'title'				=> __('Page Slider'),
            'description'		=> __('Page slider'),
            'render_template'	=> 'template-parts/blocks/page-slider-block.php',
            'render_callback'	=> 'page-slider-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'keywords'			=> array( 'banner, slider' ),
        ));
    }
}

add_action('acf/init', 'acf_page_slider');

function acf_page_banner() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'page-banner',
            'title'				=> __('Page Banner'),
            'description'		=> __('Page Banner'),
            'render_template'	=> 'template-parts/blocks/page-banner-block.php',
            'render_callback'	=> 'page-banner-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'keywords'			=> array( 'banner, page banner' ),
        ));
    }
}

add_action('acf/init', 'acf_page_banner');

function acf_how_much_calculator() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'how_much_calculator',
            'title'				=> __('How Much Calculator'),
            'description'		=> __('How Much Calculator'),
            'render_template'	=> 'template-parts/blocks/how-much-calculator-block.php',
            'render_callback'	=> 'how_much_calculator.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'keywords'			=> array( 'calculator, borrow, how much' ),
        ));
    }
}

add_action('acf/init', 'acf_how_much_calculator');

function acf_intro_block() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'intro_block',
            'title'				=> __('Section Intro'),
            'description'		=> __('Section Intro'),
            'render_template'	=> 'template-parts/blocks/intro-block.php',
            'render_callback'	=> 'intro-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'keywords'			=> array( 'intro, introduction, section intro' ),
        ));
    }
}

add_action('acf/init', 'acf_intro_block');

function acf_tabs_block() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'tabs_block',
            'title'				=> __('Tabbed Content'),
            'description'		=> __('Tabbed Content'),
            'render_template'	=> 'template-parts/blocks/tabs-block.php',
            'render_callback'	=> 'tabs-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => true,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'calculator, tabs' ),
        ));
    }
}

add_action('acf/init', 'acf_tabs_block');

function acf_featureblocks() {

    // check function exists
      if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'feature-blocks',
            'title'				=> __('Feature Blocks'),
            'description'		=> __('Feature Blocks'),
            'render_template'	=> 'template-parts/blocks/feature-blocks.php',
            'render_callback'	=> 'feature-blocks.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'feature' ),
        ));
    }
}

add_action('acf/init', 'acf_featureblocks');

function acf_trustpilotReviews() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'trustpilot-reviews',
            'title'				=> __('Trustpilot'),
            'description'		=> __('Trustpilot'),
            'render_template'	=> 'template-parts/blocks/trustpilotReviews.php',
            'render_callback'	=> 'trustpilot.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'trustpilot, reviews' ),
        ));
    }
}

add_action('acf/init', 'acf_trustpilotReviews');

function acf_newsletterSignup() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'newsletter-signup',
            'title'				=> __('Newsletter Signup'),
            'description'		=> __('Newsletter Signup'),
            'render_template'	=> 'template-parts/blocks/newsletter-signup.php',
            'render_callback'	=> 'newsletter-signup.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'newsletter signup' ),
        ));
    }
}

add_action('acf/init', 'acf_newsletterSignup');

function acf_ctatblock() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'cat-block',
            'title'				=> __('Call to Action'),
            'description'		=> __('Call to Action'),
            'render_template'	=> 'template-parts/blocks/cta-block.php',
            'render_callback'	=> 'cta-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'call to action' ),
        ));
    }
}

add_action('acf/init', 'acf_ctatblock');

function acf_approachtblock() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'approach-block',
            'title'				=> __('Personal Approach'),
            'description'		=> __('Personal Approach'),
            'render_template'	=> 'template-parts/blocks/personal-approach.php',
            'render_callback'	=> 'personal-approach.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'personal approach, approach, get in touch, contact' ),
        ));
    }
}

add_action('acf/init', 'acf_approachtblock');

function acf_formblock() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'form-block',
            'title'				=> __('Join ME'),
            'description'		=> __('Join ME'),
            'render_template'	=> 'template-parts/blocks/form-block.php',
            'render_callback'	=> 'form-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'join ME, form, contact' ),
        ));
    }
}

add_action('acf/init', 'acf_formblock');

function acf_awardsblock() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'awards-block',
            'title'				=> __('Awards'),
            'description'		=> __('Awards'),
            'render_template'	=> 'template-parts/blocks/awards-block.php',
            'render_callback'	=> 'awards-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'awards' ),
        ));
    }
}

add_action('acf/init', 'acf_awardsblock');


function acf_circleblock() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'circle-block',
            'title'				=> __('Circle Block'),
            'description'		=> __('Circle Block'),
            'render_template'	=> 'template-parts/blocks/circle-block.php',
            'render_callback'	=> 'circle-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'circle block, circle' ),
            'styles'  => [
                [
                    'name' => 'desktophide',
                    'label' => __('Hide on Desktop', 'hide'),
                    'isDefault' => true,
                ],
                [
                    'name' => 'mobilehide',
                    'label' => __('Hide on Mobile', 'abc'),
                ],
            ],
        ));
    }
}

add_action('acf/init', 'acf_circleblock');

function acf_requestcallback() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'request-callback',
            'title'				=> __('Call Back Form'),
            'description'		=> __('Call Back Form'),
            'render_template'	=> 'template-parts/blocks/request-callback.php',
            'render_callback'	=> 'request-callback.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'call back' ),
        ));
    }
}

add_action('acf/init', 'acf_requestcallback');

function acf_leftimageblock() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'left-image-block',
            'title'				=> __('Left Image Block'),
            'description'		=> __('Left Image Block'),
            'render_template'	=> 'template-parts/blocks/left-image-block.php',
            'render_callback'	=> 'left-image-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'Left image block' ),
        ));
    }
}

add_action('acf/init', 'acf_leftimageblock');

function acf_rightimageblock() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'right-image-block',
            'title'				=> __('Right Image Block'),
            'description'		=> __('Right Image Block'),
            'render_template'	=> 'template-parts/blocks/right-image-block.php',
            'render_callback'	=> 'right-image-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'Right image block' ),
        ));
    }
}

add_action('acf/init', 'acf_rightimageblock');


function acf_adviserspagebanner() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'advisers-page-banner-block',
            'title'				=> __('Advisers Page Banner'),
            'description'		=> __('Advisers Page Banner'),
            'render_template'	=> 'template-parts/blocks/advisers-page-banner-block.php',
            'render_callback'	=> 'advisers-page-banner-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'Advisers Page Banner' ),
        ));
    }
}

add_action('acf/init', 'acf_adviserspagebanner');


function acf_howitworks() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'advisers-how-it-works-block',
            'title'				=> __('Advisers How It Works'),
            'description'		=> __('Advisers How It Works'),
            'render_template'	=> 'template-parts/blocks/advisers-how-it-works-block.php',
            'render_callback'	=> 'advisers-how-it-works-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'Advisers How it Works' ),
        ));
    }
}

add_action('acf/init', 'acf_howitworks');


function acf_firststep() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'first-step-block',
            'title'				=> __('Advisers - First Steps'),
            'description'		=> __('Advisers - First Steps'),
            'render_template'	=> 'template-parts/blocks/first-step-block.php',
            'render_callback'	=> 'first-step-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'Advisers - First Step' ),
        ));
    }
}

add_action('acf/init', 'acf_firststep');

function acf_advisertabs() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'advisers-tabs-block',
            'title'				=> __('Advisers Tabs Calculator'),
            'description'		=> __('Advisers Tabs Calculator'),
            'render_template'	=> 'template-parts/blocks/advisers-tabs-block.php',
            'render_callback'	=> 'advisers-tabs-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'Advisers Tabs Calculator' ),
        ));
    }
}

add_action('acf/init', 'acf_advisertabs');


function acf_news_block() {

    // check function exists
    if( function_exists('acf_register_block') ) {

        // register a home item block
        acf_register_block(array(
            'name'				=> 'news-block',
            'title'				=> __('News'),
            'description'		=> __('News'),
            'render_template'	=> 'template-parts/blocks/news-block.php',
            'category'			=> 'layout',
            'icon'				=> 'excerpt-view',
            'supports'		    => [
                'align'			    => false,
                'anchor'		    => true,
                'customClassName'	=> true,
                'jsx' 			    => true,
            ],
            'keywords'			=> array( 'news' ),
        ));
    }
}

add_action('acf/init', 'acf_news_block');
