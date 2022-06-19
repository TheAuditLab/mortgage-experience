<?php
require_once(get_template_directory() . "/libs/client/base.php");

/**
 * Class archives
 * Handler for the archives CPT.
 */
class archives extends CL_Base
{
    private $name = 'archives';

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

        $this->addViewHelpers(array('Data', 'Image'));
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
                'editor',
                'author',
                'excerpt',
                'revisions',
                'comments',
                'page-attributes',
                'post-formats'
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
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => $rewrite,
            'capability_type' => 'page',
        );
        register_post_type($this->name, $args);
    }
}