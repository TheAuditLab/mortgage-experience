<?php

// Load the functions from the client library.
require_once(get_template_directory() . "/libs/client/functions.php");
$functions = new CL_Functions();

define("THEME_VERSION", "12345");


add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function my_theme_enqueue_styles()
{

    $parent_style = 'parent-style';
    wp_enqueue_style('parent-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('parent-style', 'rtl', 'replace');

    wp_enqueue_style( 'adobe-typekit', '//use.typekit.net/jxo5jyc.css' );

    wp_enqueue_style(
        'vendor-style',
        get_stylesheet_directory_uri() . '/dist/css/vendor.min.css?v=' . THEME_VERSION,
        array(), null
    );
    wp_enqueue_style(
        'plugins-style',
        get_stylesheet_directory_uri() . '/dist/css/plugins.min.css?v=' . THEME_VERSION,
        array(), null
    );
    wp_enqueue_style(
        'main-style',
        get_stylesheet_directory_uri() . '/assets/css/style.css?v=' . THEME_VERSION,
        array(), null
    );



    // Manually enqueue dashicons and admin-bar
    wp_dequeue_style('dashicons');
    wp_dequeue_style('admin-bar');
    wp_enqueue_style('manual-dashicons', '/' . WPINC . '/css/dashicons.min.css');
    wp_enqueue_style('manual-admin-bar', '/' . WPINC . '/css/admin-bar.min.css');



}

function register_scripts()
{

    /** MAIN THEME JS **/

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js?ver=5.8.3', array(), null, true);

    wp_enqueue_script('modernizer', get_template_directory_uri() . '/dist/js/modernizr-2.8.3.min.js', array('jquery'), _S_VERSION);
    wp_enqueue_script('mortgage-experience-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), _S_VERSION, true);
    wp_register_script('main-vendor-js', get_stylesheet_directory_uri() . '/dist/js/vendor.min.js', array('jquery'), THEME_VERSION, true);
    wp_register_script('main-js-plugins', get_stylesheet_directory_uri() . '/dist/js/plugins.min.js', array('jquery'), THEME_VERSION, true);
    wp_register_script('mortgage-app-js', get_stylesheet_directory_uri() . '/dist/js/app.min.js', array('jquery'), THEME_VERSION, true);
    wp_enqueue_script('trustpilot', '//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js', array(), null, true);
    wp_enqueue_script(['modernizer', 'mortgage-experience-navigation', 'main-vendor-js', 'main-js-plugins', 'mortgage-app-js','trustpilot']);
}

add_action('wp_enqueue_scripts', 'register_scripts');



/**
 * mortgage-experience functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mortgage-experience
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

if (!function_exists('mortgage_experience_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function mortgage_experience_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on mortgage-experience, use a find and replace
         * to change 'mortgage-experience' to the name of your theme in all the template files.
         */
        load_theme_textdomain('mortgage-experience', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'mortgage-experience'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'mortgage_experience_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            )
        );

        add_theme_support('disable-custom-colors');

        // Editor color palette.

        $white = '#fff';
        $black = '#000';
        $purple = '#483C5E';
        $yellow = '#fbbf00';
        $gray = '#737166';
        $lightgray = '#E6E6E6';
        $softblack = '#222222';
        $blue = '#1B9CBB';
        $overlaybeige = '#C6C0BF';
        $overlaybrown = '#8E8480';
        $overlayblue = '#1697B7';
        $overlaygray = '#DFDEDE';


        add_theme_support(
            'editor-color-palette',
            array(
                array(
                    'name' => esc_html__('Black', 'mortgage-experience'),
                    'slug' => 'black',
                    'color' => $black,
                ),
                array(
                    'name' => esc_html__('Soft Black', 'mortgage-experience'),
                    'slug' => 'softblack',
                    'color' => $softblack,
                ),
                array(
                    'name' => esc_html__('White', 'mortgage-experience'),
                    'slug' => 'white',
                    'color' => $white,
                ),
                array(
                    'name' => esc_html__('Gray', 'mortgage-experience'),
                    'slug' => 'gray',
                    'color' => $gray,
                ),
                array(
                    'name' => esc_html__('Light Gray', 'mortgage-experience'),
                    'slug' => 'lightgray',
                    'color' => $lightgray,
                ),
                array(
                    'name' => esc_html__('Purple', 'mortgage-experience'),
                    'slug' => 'purple',
                    'color' => $purple,
                ),
                array(
                    'name' => esc_html__('Yellow', 'mortgage-experience'),
                    'slug' => 'yellow',
                    'color' => $yellow,
                ),
                array(
                    'name' => esc_html__('Blue', 'mortgage-experience'),
                    'slug' => 'blue',
                    'color' => $blue,
                ),
                array(
                    'name' => esc_html__('Overlay Beige', 'mortgage-experience'),
                    'slug' => 'overlay-beige',
                    'color' => $overlaybeige,
                ),
                array(
                    'name' => esc_html__('Overlay Blue', 'mortgage-experience'),
                    'slug' => 'overlay-blue',
                    'color' => $overlayblue,
                ),
                array(
                    'name' => esc_html__('Overlay Gray', 'mortgage-experience'),
                    'slug' => 'overlay-gray',
                    'color' => $overlaygray,
                ),
                array(
                    'name' => esc_html__('Overlay Brown', 'mortgage-experience'),
                    'slug' => 'overlay-brown',
                    'color' => $overlaybrown,
                ),

            )
        );


    }
endif;
add_action('after_setup_theme', 'mortgage_experience_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mortgage_experience_content_width()
{
    $GLOBALS['content_width'] = apply_filters('mortgage_experience_content_width', 640);
}

add_action('after_setup_theme', 'mortgage_experience_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mortgage_experience_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'mortgage-experience'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'mortgage-experience'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}

add_action('widgets_init', 'mortgage_experience_widgets_init');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Disable the emoji's
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    // Remove from TinyMCE
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}

add_action('init', 'disable_emojis');

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

if (!function_exists('ninja_forms_360dotnet_integration_callback')) {

    /**
     * Ninja Forms hook for 360dotnet integration
     * @param $form_data
     */
    function ninja_forms_360dotnet_integration_callback($form_data)
    {
        require_once get_template_directory() . '/360dotnet/360dotnet.php';

        if (!class_exists('_360dotnet')) {
            error_log('ninja_forms_360dotnet_integration_callback: required class _360dotnet doesn\'t exist.');
            return;
        }

        $formData = [
            'form' => sanitize_title($form_data['settings']['title'])
        ];

        foreach ($form_data['fields'] as $field) {
            if (!array_key_exists('admin_label', $field)) {
                continue;
            }

            switch ($field['admin_label']) {
                case 'full-name':
                case 'first-name':
                case 'last-name':
                case 'phone':
                case 'email':
                case 'metadata':
                    $formData[$field['admin_label']] = $field['value'];
                    break;
                default:
                    break;
            }
        }

        $environment = get_field('360dotnet_integration_environment', 'option') ? 'LIVE' : 'DEV';

        $_360dotnet = new _360dotnet($formData, $environment);
        $_360dotnet->submit();
    }

    add_action('ninja_forms_360dotnet_integration', 'ninja_forms_360dotnet_integration_callback');

}