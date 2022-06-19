<?php
require_once(get_template_directory() . "/libs/client/base.php");

/**
 * Class news
 * Handler for the news/feed page.
 */
class news extends CL_Base
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
     * Get's the content type.
     * @return string
     */
    public function getContentType()
    {
        $post_type = get_post_type(get_the_ID());
        if ($post_type == 'tweets') {
            return 'twitter';
        } elseif ($post_type == 'insta_team') {
            return 'image';
        } else {
            // For pinterest
            $post_categories = wp_get_post_categories(get_the_ID());
            if (!empty($post_categories)) {
                foreach ($post_categories as $c) {
                    $cat = get_category($c);

                    if(isset($cat->term_id) && $cat->term_id == 13){
                        return 'image';
                    }
                }
            }

            $format = get_post_format(get_the_ID());
            if (false === $format) {
                return 'news';
            } elseif ($format == 'image') {
                return 'image';
            } elseif ($format == 'status') {
                return 'twitter';
            }
        }
    }

    /**
     * Is the image an instagram one.
     * @return bool
     */
    public function isInstaImage()
    {
        $post_type = get_post_type(get_the_ID());
        if ($post_type == 'insta_team') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the image in from the correct medium.
     * @return mixed
     */
    public function getImageFormat()
    {
        if ($this->isInstaImage()) {
            preg_match('/<img.+src=[\'"](?P<src>.+)[\'"].*>/i', get_the_content(), $image);
            return $image['src'];
        } else {
            if (has_post_thumbnail()) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                return $image[0];
            } else {
                preg_match('/<img.+src=[\'"](?P<src>.+)[\'"].*>/i', get_the_content(), $image);
                return $image['src'];
            }
        }
    }
}