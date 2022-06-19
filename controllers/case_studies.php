<?php
require_once(get_template_directory() . "/libs/client/base.php");

/**
 * Class work
 * For controlling the work CPT + Archive.
 */
class case_studies extends CL_Base
{
    private $name = 'case_studies';

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
        $post_name = str_replace(array("_", "-"), ' ', $this->name);
        $labels = array(
            'name'               => _x(
                str_replace(array('_', '-'), ' ', ucwords($post_name) . ''),
                'Post Type General Name', 'text_domain'
            ),
            'singular_name'      => _x(
                str_replace(array('_', '-'), ' ', ucwords($post_name)),
                'Post Type Singular Name', 'text_domain'
            ),
            'menu_name'          => __(
                str_replace(array('_', '-'), '', ucwords($post_name)),
                'text_domain'
            ),
            'parent_item_colon'  => __(
                str_replace(array('_', '-'), ' ', 'Parent ' . ucwords($post_name)),
                'text_domain'
            ),
            'all_items'          => __(
                str_replace(array('_', '-'), ' ', 'All ' . ucwords($post_name)),
                'text_domain'
            ),
            'view_item'          => __(
                str_replace(array('_', '-'), ' ', 'View ' . ucwords($post_name)),
                'text_domain'
            ),
            'add_new_item'       => __(
                str_replace(array('_', '-'), ' ', 'Add New ' . ucwords($post_name)),
                'text_domain'
            ),
            'add_new'            => __(
                str_replace(array('_', '-'), ' ', 'New ' . ucwords($post_name)),
                'text_domain'
            ),
            'edit_item'          => __(
                str_replace(array('_', '-'), ' ', 'Edit ' . ucwords($post_name)),
                'text_domain'
            ),
            'update_item'        => __(
                str_replace(array('_', '-'), ' ', 'Update ' . ucwords($post_name)),
                'text_domain'
            ),
            'search_items'       => __(
                str_replace(array('_', '-'), ' ', 'Search ' . ucwords($post_name)),
                'text_domain'
            ),
            'not_found'          => __(
                str_replace(array('_', '-'), ' ', 'No ' . $post_name . ' found'),
                'text_domain'
            ),
            'not_found_in_trash' => __(
                str_replace(array('_', '-'), ' ', 'No ' . $post_name . ' found in Trash'),
                'text_domain'
            ),
        );
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
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => $rewrite,
            'capability_type' => 'page',
        );
        register_post_type($this->name, $args);
    }
}