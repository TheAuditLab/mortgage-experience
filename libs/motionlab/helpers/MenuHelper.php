<?php
/**
 * Class ML_MenuHelper
 * Menu helper for getting nice formats
 * of menu so we can work with them.
 */
class ML_MenuHelper{
    private $levels   = array();
    private $parents  = array();
    private $children = array();

    /**
     * Gets a sensible menu array, in a semi conductive format.
     * @param string $menu
     * @param null $current_page
     * @param bool $top_menu_only
     *
     * @return array
     */
    public function generateMenu($menu = 'header-menu', $current_page = null, $top_menu_only = false){
        // Reset the helper.
        $this->resetMenu();

        if(!is_numeric($menu)){
            $menu_locations = get_nav_menu_locations();
            $menu           = $menu_locations[$menu];
        }
        $args  = array(
            'order'   => 'ASC',
            'orderby' => 'menu_order',
        );
        $items = wp_get_nav_menu_items($menu, $args);
        $items = apply_filters('wp_nav_menu_objects', $items, $args);

        if(empty($current_page)){
            $return_array = $this->getMenuAll($items);
            if($top_menu_only){
                $return_array = $this->getTopMenuItems($return_array);
            }
        }else{
            $return_array = $this->getCurrentMenu($current_page);
            if($top_menu_only){
                $return_array = $this->getTopMenuItems($return_array);
            }
        }

        return $return_array;
    }

    /**
     * Used for resetting the menu
     * attributes when generating a
     * menu.
     *
     * This is sorta a big deal.
     */
    private function resetMenu(){
        $this->levels = array();
        $this->parents = array();
        $this->children = array();
    }

    /**
     * Get's all the menu items.
     * @param $items
     * @return array
     */
    private function getMenuAll($items){
        $return_array = array();
        if(!empty($items)){
            foreach($items AS $nav){
                if($nav->menu_item_parent == 0){
                    $this->parents[] = $nav;
                    $this->addMenuLevel(0, $nav->ID);
                }else{
                    $level = $this->getMenuLevel($nav->menu_item_parent);
                    if(!$level){
                        $level = 1;
                    }else{
                        $level = $level + 1;
                    }
                    $this->children[$level][$nav->menu_item_parent][$nav->ID] = $nav;
                    $this->addMenuLevel($level, $nav->ID);
                }
            }
            if(!empty($this->children)){
                foreach($this->parents AS $parent){
                    $return_array[] = $this->getMenuChildren($parent);
                }
            }else{
                $return_array = $this->parents;
            }
        }

        return $return_array;
    }

    /**
     * Get's menu children
     * @param $parent
     * @return array
     */
    private function getMenuChildren($parent){
        $level = $this->getMenuLevel($parent->ID);
        $level = $level + 1;

        if(isset($this->children[$level][$parent->ID])){
            $childs = $this->children[$level][$parent->ID];
        }

        $return_children = array();
        if(!empty($childs)){
            foreach($childs AS $child){
                $return_children[] = $this->getMenuChildren($child);
            }
        }

        return array(
            'parent'   => $parent,
            'children' => $return_children
        );
    }

    /**
     * Get's a particular menu level.
     * @param $menu_id
     * @return int|string
     */
    private function getMenuLevel($menu_id){
        if(!empty($this->levels)){
            foreach($this->levels AS $level => $values){
                if(!empty($values)){
                    if(in_array($menu_id, $values)){
                        return $level;
                    }
                }
            }
        }
    }

    /**
     * Add's a menu level
     * @param $level
     * @param $item_id
     */
    private function addMenuLevel($level, $item_id){
        $this->levels[$level][] = $item_id;
    }

    /**
     * Get only top level menu items.
     * @param $items
     * @return array
     */
    private function getTopMenuItems($items){
        $return_array = array();
        if(!empty($items)){
            foreach($items AS $nav){
                if(array_key_exists('parent', $nav)){
                    if($nav['parent']->menu_item_parent == 0){
                        $return_array[] = $nav['parent'];
                    }
                }else{
                    if($nav->menu_item_parent == 0){
                        $return_array[] = $nav;
                    }
                }
            }
        }
        return $return_array;
    }

    /**
     * Get's a specific attribute from a menu.
     * @param $menu
     * @param $attr
     *
     * @return bool
     */
    public function getMenuAttribute($menu, $attr){
        if(!is_numeric($menu)){
            $menu_locations = get_nav_menu_locations();
            $menu           = $menu_locations[$menu];
        }
        $menu_obj = wp_get_nav_menu_object($menu);
        if(!empty($menu_obj)){
            return esc_attr($menu_obj->$attr);
        }else{
            return false;
        }
    }

    /**
     * Rather than sorting the results in @see $this->generateMenu();
     * get the unfiltered list of menu items.
     * @param string $menu
     *
     * @return mixed
     */
    public function getMenuItems($menu = 'header-menu'){
        if(!is_numeric($menu)){
            $menu_locations = get_nav_menu_locations();
            $menu           = $menu_locations[$menu];
        }
        $args  = array(
            'order'   => 'ASC',
            'orderby' => 'menu_order',
        );
        $items = wp_get_nav_menu_items($menu, $args);
        return $items;
    }

    /**
     * Get's the correct menu id for retrieving
     * the current page array.
     * @param $post
     * @return mixed
     */
    public function getMenuIDFromPost($post){
        if($post instanceof WP_Post){
            $id = $post->ID;
        }else{
            $id = $post;
        }
        $menu_obj_full = $this->getMenuItems('main-menu');
        if(!empty($menu_obj_full)){
            foreach($menu_obj_full AS $obj){
                if($obj->object_id == $id){
                    if($obj->menu_item_parent != 0){
                        $return = $obj->menu_item_parent;
                    }else{
                        $return = $obj->ID;
                    }
                }
            }
        }
        return $return;
    }

    /**
     * Get's the correct menu for a particular page.
     * @param $page_id
     * @return array
     */
    public function getCurrentMenu($page_id){
        if($page_id instanceof WP_Post){
            $page_id = $page_id->ID;
        }
        $menu_obj_full = $this->getMenuItems('main-menu');
        $return_array  = array();
        if(!empty($menu_obj_full)){
            foreach($menu_obj_full AS $obj){
                if($obj->ID == $page_id){
                    $return_array['parent'] = $obj;
                }elseif($obj->menu_item_parent == $page_id){
                    $return_array['children'][] = $obj;
                }
            }
        }
        return $return_array;
    }

    /**
     * Get the proper full URL
     * @return string
     */
    public function fullUrl(){
        $s        = &$_SERVER;
        $ssl      = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true : false;
        $sp       = strtolower($s['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port     = $s['SERVER_PORT'];
        $port     = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
        $host     = isset($s['HTTP_X_FORWARDED_HOST']) ? $s['HTTP_X_FORWARDED_HOST'] : isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : $s['SERVER_NAME'];
        return $protocol . '://' . $host . $port . $s['REQUEST_URI'];
    }
}