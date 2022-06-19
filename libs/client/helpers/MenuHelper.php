<?php
/**
 * Class MenuHelper
 * This class extends the base menu helper.
 * It can be used to add client specific menu helpers
 * or overwrite specific ones for the client.
 */
require_once(get_template_directory() . "/libs/motionlab/helpers/MenuHelper.php");

class CL_MenuHelper extends ML_MenuHelper
{
    /**
     * Displays a child in the correct html format.
     * @param $child
     * @return string
     */
    public function displayChild($child)
    {
        $return_html = '';
        if (count($child['children'])) {
            $return_html .= '<li class="has-children">';
        } else {
            $return_html .= '<li>';
        }
        $return_html .= '<a href="' . $this->getMenuPermalink($child['parent']) . '">' . esc_attr($child['parent']->title) . '</a>';
        if (count($child['children'])) {
            $return_html .= '<ul class="ul-reset sub-menu">';
            foreach ($child['children'] AS $child_childs) {
                $return_html .= '<li><a href="' . $this->getMenuPermalink($child_childs['parent']) . '">' . esc_attr($child_childs['parent']->title) . '</a></li>';
            }
            $return_html .= '</ul>';
        }
        $return_html .= '</li>';
        return $return_html;
    }

    /**
     * Get's the correct class
     * for the menu item.
     * @param $menu_item
     * @return string
     */
    public function getMenuClasses($menu_item)
    {
        $classes = '';
        if (!empty($menu_item->classes)) {
            foreach ($menu_item->classes AS $class) {
                $classes .= ' ' . esc_attr($class);
            }
        }
        return $classes;
    }

    /**
     * Get's the correct menu permalink
     * for the menu item.
     * @param $menu_item
     * @return string
     */
    public function getMenuPermalink($menu_item)
    {
        if ($menu_item->type == 'custom') {
            $url = esc_url($menu_item->url);
        } else {
            $url = esc_url(get_permalink($menu_item->object_id));
        }
        return $url;
    }

    /**
     * For getting the children menu's
     * special case for this site really.
     */
    public function getChildMenu()
    {

    }

    /**
     * Checks if the page passed is the currently
     * active page.
     * @param $menu_url
     * @return bool
     */
    public function getActive($menu_url)
    {
        $current_url = explode("/", $this->fullUrl());
        if (is_archive()) {
            // Get the current query object so we can get the taxonomy.
            $query = get_queried_object();
            if (is_category()) {
                if(strpos($menu_url, '/blog') !== false && strpos($menu_url, '/blog/category') == false){
                    return true;
                }
            } elseif (is_tax()) {
                if (isset($query->taxonomy)) {
                    // Get the post type from the taxonomy.
                    $post_type = $this->get_post_types_by_taxonomy($query->taxonomy);
                    if (!empty($post_type)) {
                        // get the post type URL.
                        $post_type_data = get_post_type_object($post_type[0]);
                        $post_type_slug = $post_type_data->rewrite['slug'];
                        if (!empty($post_type_slug)) {
                            if (in_array($post_type_slug, $menu_url)) {
                                return true;
                            }
                        }
                    }
                }
            } else {
                if (!empty($query) && isset($query->name) && isset($query->rewrite['slug'])) {
                    $post_type = $query->name;
                    $slug = "/" . $query->rewrite['slug'] . "/";;

                    if (strpos($slug, $menu_url) !== false) {
                        return true;
                    }
                }
            }
        } else {
            if (isset($current_url[3]) && !empty($current_url[3])) {
                if (isset($current_url[4]) && !empty($current_url[4])) {
                    if (strpos($menu_url, $current_url[3]) !== false && strpos($menu_url, $current_url[4]) !== false) {
                        return true;
                    }
                } else {
                    if (strpos($menu_url, $current_url[3]) !== false) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function getActiveBlog ($item){
        $query = get_queried_object();

        if ($query->taxonomy == 'category' && strpos($item, '/blog/category/' . $query->category_nicename) !== false) {
            return true;
        }
    }

    public function getActiveWork($item)
    {
        if ((strpos($item, '/work') !== false && strpos($this->fullUrl(), '/work') !== false) && (strpos($item,
                    '/blog') === false && strpos($this->fullUrl(), '/blog') === false)
        ) {
            return true;
        }
    }

    /**
     * This is a bit weird.
     * But basically it search for the slug in the array.
     * @param $menu_items
     * @param $slug
     * @return mixed
     */
    public function findParentSlug($menu_items, $slug)
    {
        if (!empty($menu_items)) {
            foreach ($menu_items AS $items) {
                if (strpos($items['parent']->url, '/' . $slug) !== false) {
                    return $items['parent'];
                }
                if (isset($items['children']) && !empty($items['children'])) {
                    foreach ($items['children'] AS $child) {
                        if (strpos($child['parent']->url, '/' . $slug) !== false) {
                            return $items['parent'];
                        }
                        if (isset($child['children']) && !empty($child['children'])) {
                            foreach ($child['children'] AS $child_child) {
                                if (strpos($child_child['parent']->url, '/' . $slug) !== false) {
                                    return $items['parent'];
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Get's children from the current
     * parent.
     * @param $menu_items
     * @param $parent
     * @return mixed
     */
    public function getChildrenFromParent($menu_items, $parent)
    {
        if (!empty($menu_items)) {
            foreach ($menu_items AS $items) {
                if ($items['parent']->ID == $parent->ID) {
                    return $items;
                }
            }
        }
    }

    /**
     * Get's the post types from a
     * taxonomy.
     * @param string $tax
     * @return array
     */
    function get_post_types_by_taxonomy($tax = 'category')
    {
        $out = array();
        $post_types = get_post_types();
        foreach ($post_types as $post_type) {
            $taxonomies = get_object_taxonomies($post_type);
            if (in_array($tax, $taxonomies)) {
                $out[] = $post_type;
            }
        }
        return $out;
    }
}