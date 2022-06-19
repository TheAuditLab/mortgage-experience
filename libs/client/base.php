<?php
require_once(get_template_directory() . "/libs/motionlab/base.php");

/**
 * Class CL_Base
 * This is for client specific global functionality.
 * OR
 * Client specific base overwrites.
 */
abstract class CL_Base extends ML_Base
{
    /**
     * Class construct.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Function for escaping WYSIWYG fields.
     * or field that need some HTML.
     * @param $content
     * @return string
     */
    public function eTags($content)
    {
        return wp_kses(
            $content,
            array(
                'a' => array(
                    'href' => array(),
                    'title' => array(),
                    'class' => array()
                ),
                'img' => array(
                    'src' => array(),
                    'class' => array()
                ),
                'p' => array('class' => array()),
                'br' => array('class' => array()),
                'em' => array('class' => array()),
                'strong' => array(),
                'ul' => array('class' => array()),
                'li' => array('class' => array()),
                'h1' => array('class' => array()),
                'h2' => array('class' => array()),
                'h3' => array('class' => array()),
                'h4' => array('class' => array())
            )
        );
    }

    /**
     * Get's the latest jobs.
     * @param int $posts - Number of posts to get.
     * @return array
     */
    public function latest_jobs($posts = 3)
    {
        return get_posts(
            array(
                'post_type' => 'jobs',
                'posts_per_page' => $posts
            )
        );
    }

    /**
     * Get's a particular social networks share link
     * of the current page.
     * @param string $network
     * @param $type
     * @return string
     */
    public function getSocialURL($network = 'facebook', $type = links, $text=null)
    {

        if(is_post_type_archive('jobs')){
            $text = urlencode('View our current roles');
            $summary = urlencode("We're looking for enthusiastic, creative talent to join the team at Motionlab.");
        }elseif(is_singular('jobs')){
            $text = urlencode(get_the_title()." role at Motionlab");
            if(get_field('excerpt')) {
                $summary = urlencode(get_field('excerpt'));
            }else{
                $summary = urlencode('Careers in '.$text);
            }
        }else{
            if(!is_archive()) {
                if (get_the_excerpt()) {
                    $summary = urlencode(get_the_excerpt());
                } else {
                    $summary = urlencode(get_the_title() . " Motionlab");
                }
            }
        }

        switch ($type) {
            case 'links':
                switch ($network) {
                    case 'facebook':
                        return esc_url(get_field('facebook_link', 'option'));
                        break;
                    case 'twitter':
                        return esc_url(get_field('twitter_link', 'option'));
                        break;
                    case 'linkedin':
                        return esc_url(get_field('linkedin_link', 'option'));
                        break;
                }
                break;
            case 'share':
                switch ($network) {
                    case 'facebook':
                        return 'http://www.facebook.com/sharer.php?u=' . urlencode($this->fullUrl());
                        break;
                    case 'twitter':
                        return 'https://twitter.com/share?url=' . urlencode($this->fullUrl()).'&text='.$text.'&hashtags=motionlab';
                        break;
                    case 'linkedin':
                        return 'http://www.linkedin.com/shareArticle?mini=true&url=' . $this->fullUrl().'&title='.$text.'&summary='.$summary;
                        break;
                }
                break;
        }
    }

    /**
     * Get other work items
     * @param int $posts - The number of work posts to return
     * @return array
     */
    public function otherWork($posts = 4)
    {
        $params = array(
            'post_type' => 'work',
            'posts_per_page' => $posts
        );
        if (is_singular('work')) {
            $params['post__not_in'] = array(get_the_ID());
        }

        return get_posts($params);
    }

    /**
     * Get's the anchor attributes from a html page.
     * This returns the first link + text in an array
     * @param $html string
     * @return array
     */
    public function getAnchorAttributes($html)
    {
        $return_array = array();

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $elementA = $dom->getElementsByTagName('a')->item(0);
        if ($elementA) {
            $return_array['link'] = $elementA->getAttribute('href');
            $return_array['text'] = $elementA->nodeValue;
        }

        return $return_array;
    }

    public function human_filesize($bytes, $decimals = 2) {
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    /**
     * Number of times to repeat a group
     * of items so they are >= to a minimum number
     * of required items
     *
     * @param $num_items
     * @param $min_required_items
     * @return int
     */
    public function getRepeatVal($num_items, $min_required_items) {
        if($num_items >= $min_required_items) {
            return 1;
        }

        if($num_items <= 0) {
            return 1;
        }

        $repeat_val = ceil($min_required_items / $num_items);
        return $repeat_val;
    }
}