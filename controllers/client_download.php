<?php
require_once(get_template_directory() . "/libs/client/base.php");

/**
 * Class jobs
 * Handler for the jobs CPT and archive page.
 */
class client_download extends CL_Base
{
    private $name = 'client_download';

    /**
     * Construct for the controller
     *
     * @param null $body
     */
    public function __construct($body = null)
    {

        parent::__construct();

        if (!empty($body)) {
            $this->addBodyClasses($body);
        }

        $this->addViewHelpers(array('Data', 'Image', 'Menu'));
        $this->addIncludes(basename(__FILE__), true);
    }

    /**
     *  Generates the post type.
     */
    public function getPostType()
    {
        $labels = $this->generatePostTypeLabels($this->name);
        $rewrite = $this->generatePostTypeRewrite($this->name);

        $args = array(
            'label' => __($this->name, 'text_domain'),
            'description' => __(ucfirst($this->name), 'text_domain'),
            'labels' => $labels,
            'supports' => array(
                'title',
                'author',
                'revisions',
                'page-attributes'
            ),
            'taxonomies' => array(),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 27,
            'menu_icon' => 'dashicons-welcome-widgets-menus',
            'can_export' => true,
            'has_archive' => false,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => $rewrite,
            'capability_type' => 'page',
        );
        register_post_type($this->name, $args);
    }

    public function getFilePathFromURL($url){
        return get_home_path().str_replace(array("http://dev.motionlab.d3z.uk/", "http://www.motionlab.co.uk/"), "", $url);
    }

    public function getMimeConversion($mime){
        switch($mime){
            case 'application/zip':
                return 'zip';
                break;
        }
    }
}