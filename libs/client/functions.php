<?php
require_once(get_template_directory() . "/libs/motionlab/functions.php");

/**
 * Class CL_Functions
 * Client specific functions.
 */
class CL_Functions extends ML_Functions
{
    // List all of your custom post types/taxonmies here.
    // This will generate the necessary calls.
   // private $post_types = array('tweets', 'jobs', 'work', 'archives', 'client_download', 'case_studies');

    public function __construct()
    {
        parent::__construct($this->post_types);
        // Less compilation off by default now.
        //add_action('init', array($this, 'autoCompileLess'));

        // Registers the navigation locations
        add_action('init', array($this, 'register_navigations'));
        // Generates the correct image sizes.
        add_action('init', array($this, 'image_sizes'));
        // Generating the option pages.
        add_action('init', array($this, 'option_pages'));
        // For Generating Crons
        add_action('wp', array($this, 'cron_activation'));
        // Allows featured images to be uploaded.
        // This is being used in posts on this current project.
        // I've never seen this not needed ever.
        add_theme_support('post-thumbnails');
        add_theme_support('post-formats', array('gallery', 'link', 'image', 'quote', 'status', 'video'));

        // For changing items in the query. Example.
        add_action('pre_get_posts', array($this, 'edit_queries'));
        // Custom URLS
        add_action('init', array($this, 'custom_rewrite_tag'));
        add_action('init', array($this, 'custom_rewrites'));

        // Allow certain other file types to be uploaded.
        // Must be careful with this..
        add_filter('upload_mimes', array($this, 'cc_mime_types'));

        add_filter('show_admin_bar', '__return_false');
        add_action('admin_menu', array($this, 'stop_access_profile'));

        // Gravity Forms Actions.
        add_filter('gform_submit_button', array($this, 'gform_submit_button'), 10, 2);
        add_filter('gform_field_content', array($this, 'gform_field_content'), 10, 2);

        // WYSIWYG Actions
        add_action('admin_init', array($this, 'add_css_to_editor'));
        add_filter('mce_buttons_2', array($this, 'mce_editor_buttons'));
        add_filter('tiny_mce_before_init', array($this, 'mce_before_init'));

        add_action('dg_tw_after_post_published', array($this, 'add_twitter_cats'));
    }


    /**
     * Stops none wanted profiles from accessing the wp-admin
     */
    function stop_access_profile()
    {
        $userId = get_current_user_id();
        $userData = get_userdata($userId);
        $accountInfo = $userData->roles;

        $allowed_roles = array('admin', 'administrator', 'editor');

        $redirect = true;
        foreach ($allowed_roles AS $allowed) {
            if (is_array($accountInfo)) {
                if (in_array($allowed, $accountInfo)) {
                    $redirect = false;
                }
            } elseif (strpos($accountInfo, $allowed) !== false) {
                $redirect = false;
            }
        }

        if (is_super_admin()) {
            $redirect = false;
        }

        if ($redirect) {
            wp_redirect(get_site_url());
            exit;
        }
    }

    public function add_twitter_cats($dg_tw_this_post)
    {
        if (!is_wp_error($dg_tw_this_post)) {
            $post = get_post($dg_tw_this_post);

            if (!empty($post)) {
                $content = get_the_content($dg_tw_this_post);

                $content = strtolower($content);

                if (strpos($content, '#work') !== false) {
                    wp_set_post_categories($dg_tw_this_post, array(219), true);
                }
                if (strpos($content, '#mlwork') !== false) {
                    wp_set_post_categories($dg_tw_this_post, array(219), true);
                }

                if (strpos($content, '#insight') !== false) {
                    wp_set_post_categories($dg_tw_this_post, array(218), true);
                }
                if (strpos($content, '#mlinsight') !== false) {
                    wp_set_post_categories($dg_tw_this_post, array(218), true);
                }

                if (strpos($content, '#culture') !== false) {
                    wp_set_post_categories($dg_tw_this_post, array(217), true);
                }
                if (strpos($content, '#mlculture') !== false) {
                    wp_set_post_categories($dg_tw_this_post, array(217), true);
                }
            }
        }
    }

    /**
     * Adding buttons for styling to the editor/WYSIWYG
     * @param $buttons
     * @return mixed
     */
    public function mce_editor_buttons($buttons)
    {
        array_unshift($buttons, 'styleselect');
        return $buttons;
    }

    /**
     * Adding buttons for styling to the editor/WYSIWYG
     * @param $settings
     * @return mixed
     */
    public function mce_before_init($settings)
    {
        $style_formats = array(
            array(
                'title' => 'Default grey text',
                'selector' => 'p',
                'classes' => 'gray'
            ),

            array(
                'title' => 'Heading',
                'block' => 'h3'
            ),
        );

        $settings['style_formats'] = json_encode($style_formats);

        return $settings;

    }


    /**
     * Adds CSS style to the editor WYSIWYG.
     */
    public function add_css_to_editor()
    {
        add_editor_style(get_template_directory_uri() . '/css/basscss-custom.css');
    }

    /**
     * Amend fields.
     * @param $field_content
     * @param $field
     * @return mixed
     */
    public function gform_field_content($field_content, $field)
    {
        if ($field->type == 'text') {
            return str_replace('class="', 'class="', $field_content);
        }

        return $field_content;
    }


    /**
     * Correctly styles the submit buttons.
     * @param $button
     * @param $form
     * @return string
     */
    public function gform_submit_button($button, $form)
    {
        if ($form['id'] == 1) {
            return '<div class="py3 col col-12">
                    <button type="submit" id="gform_submit_button_{$form[\'id\']}" class="btn btn-big btn-primary full bg-black white">Apply online</button>
                </div>';
        } elseif ($form['id'] == 2) {
            return '<div class="py3 col col-12">
                    <button type="submit" id="gform_submit_button_{$form[\'id\']}" class="btn btn-big btn-primary full bg-black white">Get in touch</button>
                </div>';
        }
    }

    /**
     * Adds MIME types to the wordpress uploader.
     * @param $mimes
     * @return mixed
     */
    public function cc_mime_types($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['jpg'] = 'image/jpeg';
        $mimes['jpeg'] = 'image/jpeg';
        return $mimes;
    }

    /**
     * To handle custom tag's in URL.
     * a tag is basically a parameter.
     */
    public function custom_rewrite_tag()
    {
        /**
         * @example add_rewrite_tag('%action%', '([^&]+)');
         * @example add_rewrite_tag('%account_endpoint%', '([^&]+)');
         */
    }

    /**
     * To Handle custom URL rewrites.
     * Always used, very handy.
     */
    public function custom_rewrites()
    {
        add_rewrite_rule('^jobs/([^/]+)/thankyou?', 'index.php?page_id=599', 'top');

        $ajax_page = get_page_by_title('ajax');
        if (!empty($ajax_page) && is_object($ajax_page)) {
            add_rewrite_rule('^ajax/([^/]+)', 'index.php?page_id=' . $ajax_page->ID, 'top');
        }
    }

    /**
     * Registers the navigation menu locations.
     * Override for ML_Functions
     * @see ML_Functions::register_navigations;
     */
    public function register_navigations()
    {
        register_nav_menu('main-menu', __('Main Menu'));
        register_nav_menu('our-work', __('Our work'));
        register_nav_menu('footer-menu', __('Footer Menu'));
        register_nav_menu('privacy-menu', __('Privacy Menu'));
    }

    /**
     * Generate different image sizes.
     * This is most cases allows us not to use
     * timthumb.
     * override for ML_Functions
     * @see ML_Functions::image_sizes;
     */
    public function image_sizes()
    {
        // Homepage
        add_image_size('home_featured_pages', 389, 226, true);

        // Content Blocks
        add_image_size('square_feature_block', 720, 496, true);
        add_image_size('square_feature_block_mobile', 1169, 468, true);
        add_image_size('meet_the_team_small', 160, 240, true);
        add_image_size('our_partners_small', 305, 203, true);
        add_image_size('work_other_big', 952, 496, true);
        add_image_size('blog_news', 459, 244, true);
        add_image_size('related_blog', 452, 256, true);
        add_image_size('gallery_block', 320, 320, true);
        // Client Download
        add_image_size('client_download_contact', 80, 80, true);
    }

    /**
     * For editing certain queries for bits we need.
     * We have to be careful to isolate this to specifically
     * the section we need. It's easy to make changes here that
     * can break something else on the site.
     * @param $query
     */
    public function edit_queries($query)
    {
        global $pagenow;
        // Check if the page is an admin page.
        if (is_admin()) {

        } else {
            // Jobs Archive
            if ($query->is_main_query() && is_post_type_archive('jobs')) {
                $query->set('posts_per_page', -1);
            }

            // Blog Page
            if (!is_front_page() && is_home() && $query->is_main_query()) {
                $query->set('post_type', array('post', 'tweets', 'insta_team'));
            } elseif (is_category() && $query->is_main_query()) {
                $query->set('post_type', array('post', 'tweets', 'insta_team'));
            }

            // Works page.
            if ($query->is_main_query() && is_post_type_archive('work')) {
                $query->set('orderby', 'menu_order');
                $query->set('order', 'asc');
                $query->set('posts_per_page', -1);
            }
        }
        // Always return the query back.
        return $query;
    }

    /**
     * Generates the option pages we need.
     */
    public function option_pages()
    {
        // Check function exists.
        if( function_exists('acf_add_options_page') ) {

            // Add parent.
            $parent = acf_add_options_page(array(
                'page_title'  => __('Site General Settings'),
                'menu_title'  => __('Site Settings'),
                'redirect'    => false,
            ));

        }
    }

    /**
     * Calls our cron controller.
     */
    public function cron_activation()
    {
        require_once(get_template_directory() . "/controllers/cron.php");
    }

    /**
     * adds classes to the form.
     * @param $class
     * @return mixed|string
     */
    public function custom_form_class_attr($class)
    {
        $class .= ' form-needed';
        $class = str_replace('  ', ' ', $class);
        return $class;
    }

}
