<?php
require_once(get_template_directory() . "/libs/client/base.php");

/**
 * Class single
 * For displaying a singular page.
 */
class single extends CL_Base
{
    /**
     * Construct for the controller
     *
     * @param null $body
     */
    public function __construct($body = null)
    {
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

    /**
     * Get's the related news articles.
     * @return WP_Query
     */
    public function getRelatedNews()
    {
        global $post;
        $tags = wp_get_post_tags($post->ID);

        if ($tags) {
            $tag_ids = array();
            foreach ($tags as $individual_tag) {
                $tag_ids[] = $individual_tag->term_id;
            }
            $args = array(
                'tag__in' => $tag_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page' => 4, // Number of related posts to display.
                'caller_get_posts' => 1,
                'post_type' => 'post',
                'orderby' => 'date',
                'order' => 'DESC',
                'meta_query' => array(
                    array(
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    ),
                )
            );

            $related = new wp_query($args);
        }

        return $related;
    }

    /**
     * Get's the file extension from filename
     * @param $filename
     * @return string
     */
    public function getExtension($filename){
        $ext = explode(".", $filename);
        return strtoupper($ext[1]);
    }

    /**
     * Get's the file size.
     * @param int $attachment_id
     * @return string
     */
    public function getFileSize($attachment_id){
        $attachment = get_attached_file( $attachment_id );
        if($attachment) {
            $file_size = filesize($attachment);
            if($file_size) {
                return size_format($file_size, 2);
            }
        }
    }
}