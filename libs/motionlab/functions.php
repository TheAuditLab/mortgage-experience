<?php

/**
 * For functions to extend the overall of Wordpress and the theme,
 * that are NOT CLIENT SPECIFIC.
 * However are needed on most projects we do.
 *
 * For specific client functionality @see CL_Functions
 * If you need to change any of these values for a specific client
 * then copy the method to @see CL_Functions and this will overwrite
 * the use of this file for that method.
 *
 * Class ML_Functions
 */
class ML_Functions{
    protected $post_types = array();

    /**
     * The class construct.
     * this calls all of the shots.
     *
     * @param array $post_types
     */
    public function __construct($post_types = array()){
        if(!empty($post_types)){
            $this->post_types = $post_types;
        }

        $this->getPostTypes();
    }

    /**
     * Generate different image sizes.
     */
    function image_sizes(){
        add_image_size('mobile', 800);
    }

    /**
     * Adds excerpt support to normally not enabled places
     * such as pages.
     */
    public function add_excerpts(){
        add_post_type_support('page', 'excerpt');
    }

    /**
     * Registers the navigation menu locations.
     */
    public function register_navigations(){
        register_nav_menu('main-menu', __('Main Menu'));
        register_nav_menu('header-mini', __('Header Mini Menu'));
        register_nav_menu('boarding-side-menu', __('Boarding Side Menu'));
        register_nav_menu('footer-menu-privacy', __('Footer - Privacy'));
    }

    /**
     * This function generates all the init requests
     * for post types. It requires a class be created for the post
     * type and a name being assigned in the var post_types
     * @see post_types
     */
    private function getPostTypes(){
        if(!empty($this->post_types)){
            foreach($this->post_types AS $type){

                if(file_exists(get_template_directory() . "/controllers/" . $type . ".php")){
                    require_once(get_template_directory() . "/controllers/" . $type . ".php");
                }elseif(file_exists(get_template_directory() . "/controllers/" . $type . "Controller.php")){
                    require_once(get_template_directory() . "/controllers/" . $type . "Controller.php");
                }elseif(file_exists(get_template_directory() . "/controllers/" . str_replace(array("_",
                        "-"), '', $type) . "Controller.php")){
                    require_once(get_template_directory() . "/controllers/" . str_replace(array("_",
                            "-"), '', $type) . "Controller.php");
                }

                $class = new $type();
                if(method_exists($class, 'getPostType')){
                    $class->getPostType($type);
                }
                if(method_exists($class, 'getTaxonomy')){
                    $class->getTaxonomy($type);
                }

                add_action('init', array($class, 'getPostType'), 0);
            }
        }
    }



    /**
     * Compiles the less files into a CSS file.
     * Uses the less PHP library.
     */
    public function autoCompileLess(){
        // include lessc.inc
        if(file_exists(get_template_directory() . '/less/lessc.inc.php')){
            require_once(get_template_directory() . '/less/lessc.inc.php');

            // input and output location
            $inputFile = get_template_directory() . '/styles/less/compile.less';
            $outputFile = get_template_directory() . '/styles/style.css';

            // load the cache
            $cacheFile = $inputFile . ".cache";

            if(file_exists($cacheFile)){
                $cache = unserialize(file_get_contents($cacheFile));
            }else{
                $cache = $inputFile;
            }

            $less = new lessc;
            $less->setFormatter("compressed");
            // create a new cache object, and compile
            $newCache = $less->cachedCompile($cache);

            // output a LESS file, and cache file only if it has been modified since last compile
            if(!is_array($cache) || $newCache["updated"] > $cache["updated"]){
                file_put_contents($cacheFile, serialize($newCache));
                file_put_contents($outputFile, $newCache['compiled']);
            }
        }
    }
}
