<?php
/**
 * Class baseController
 * This holds a lot of generic functions
 * that are used on most projects.
 * DO NOT ADD ANYTHING CLIENT SPECIFIC TO THIS FILE.
 * IT IS ONLYYYY FOR ITEMS THAT CAN BE USED ON ANY PROJECT.
 * ░░░░░░░░░░░░░░░░░░░░░░░░
 * ░░░░█░▀▄░░░░░░░░░░▄▄███▀
 * ░░░░█░░░▀▄░▄▄▄▄▄░▄▀░░░█▀
 * ░░░░░▀▄░░░▀░░░░░▀░░░▄▀
 * ░░░░░░░▌░▄▄░░░▄▄░▐▀▀
 * ░░░░░░▐░░█▄░░░▄█░░▌▄▄▀▀▀▀█
 * ░░░░░░▌▄▄▀▀░▄░▀▀▄▄▐░░░░░░█
 * ░░░▄▀▀▐▀▀░░░░░░░▀▀▌▄▄▄░░░█
 * ░░░█░░░▀▄░░░░░░░▄▀░░░░█▀▀▀
 * ░░░░▀▄░░▀░░▀▀▀░░▀░░░▄█▀
 * ░░░░░█░░░░░░░░░░░░░░█░
 */
abstract class ML_Base{
    public $bodyClasses = array('body');
    public $includes    = array();
    public $cat         = "";
    public $search_page = false;
    public $helpers;

    private $template_prefix = '.phtml';
    private $current_news    = "";

    // Stores Errors.
    public $errors = array();

    /**
     * Class Constructor.
     * @param array $initialises
     */
    public function __construct($initialises = array()){
        if(!empty($initialises)){
            foreach($initialises AS $key => $value){
                $this->$key = $value;
            }
        }
    }

    /**
     * Initiate any view helpers to be used.
     * This has an hierarchical structure now.
     * + Firstly it looks in the client libs folder to see if it's there.
     * + Then secondly it looks in the Motionlab libs folder.
     * + Finally it looks in the view helper if the other two aren't there
     *   I don't see why you would need to but for the structure inspectors it is
     *   here.
     *
     * Depends how you want to work it. But I would suggest using the client helper,
     * and just overwriting/adding specific functions there. As it extends the motionlab
     * base helper first.
     *
     * @param mixed $helpers
     * @return bool
     */
    public function addViewHelpers($helpers = array()){
        if(empty($helpers)){
            return false;
        }
        if(!is_array($helpers)){
            $helpers = array($helpers);
        }
        foreach($helpers as $helper){
            $helperName         = $helper . 'Helper';
            $view_location      = get_template_directory() . '/views/helpers/';
            $client_location    = get_template_directory() . '/libs/client/helpers/';
            $motionlab_location = get_template_directory() . '/libs/motionlab/helpers/';
            if(file_exists($client_location . $helperName . '.php')){
                $helperPath = $client_location . $helperName . '.php';
                $className  = "CL_" . $helperName;
            }elseif(file_exists($motionlab_location . $helperName . '.php')){
                $helperPath = $motionlab_location . $helperName . '.php';
                $className  = "ML_" . $helperName;
            }else{
                $helperPath = $view_location . $helperName . '.php';
                $className  = $helperName;
            }
            include_once($helperPath);
            $this->$helperName = new $className();
        }
    }

    public function getLibrary($name){
        $client_location    = get_template_directory() . '/libs/client/libraries/';
        $motionlab_location = get_template_directory() . '/libs/motionlab/libraries/';
        if(file_exists($client_location . $name . '.php')){
            $libPath   = $client_location . $name . '.php';
            $className = "CL_" . $name;
        }elseif(file_exists($motionlab_location . $name . '.php')){
            $libPath   = $motionlab_location . $name . '.php';
            $className = "ML_" . $name;
        }
        include_once($libPath);
        return $className;
    }

    /**
     * Adds body classes.
     *
     * @param $class
     */
    public function addBodyClasses($class){
        if(is_array($class)){
            array_merge($this->bodyClasses, $class);
        }else{
            $this->bodyClasses[] = $class;
        }
        if(is_user_logged_in()){
            if(is_array($class)){
                array_merge($this->bodyClasses, "logged-in");
            }else{
                $this->bodyClasses[] = "logged-in";
            }
        }
        add_filter('body_class', array($this, 'handleBodyClasses'));
    }

    /**
     * Adds a category for adding to the body.
     *
     * @param $cat
     */
    public function addCat($cat){
        $this->cat = $cat;
    }

    /**
     * Add an particular include file.
     *
     * @param $basefile
     */
    public function addIncludes($basefile, $is_template = false){
        if(!$is_template){
            $this->includes[] = get_template_directory() . '/views/' . $basefile;
        }else{
            $this->includes[] = get_template_directory() . '/views/' . str_replace('.php', $this->template_prefix, str_replace('Controller', '', $basefile));
        }
    }

    /**
     * Basically generates the page view.
     * @param bool $no_header
     * @param bool $no_footer
     */
    public function renderIncludes($no_header = false, $no_footer = false){
        if(!$no_header){
            require_once(get_template_directory() . '/header.php');
        }
        if(!empty($this->includes)){
            foreach($this->includes AS $include){
                if(file_exists($include)){
                    require_once($include);
                }
            }
        }
        if(!$no_footer){
            require_once(get_template_directory() . '/footer.php');
        }
    }

    /**
     * Renders a block file out.
     * @param $basefile
     * @param array $params
     */
    public function renderBlock($basefile, $params = array()){
        if(defined('ML_CACHE') && ML_CACHE == true){
            $cache_lib_inc = $this->getLibrary('cache');
            if(!empty($cache_lib_inc)){
                $cache_lib = new $cache_lib_inc;
                if(!$cache_lib->output($basefile)){
                    ob_start();
                    $this->doRenderBlock($basefile, $params);
                    $cache_lib->store();
                }
            }
        }else{
            $this->doRenderBlock($basefile, $params);
        }
    }

    private function doRenderBlock($basefile, $params = array()){
        if(file_exists(get_template_directory() . '/views/blocks/' . $basefile . '.phtml')){
            require(get_template_directory() . '/views/blocks/' . $basefile . '.phtml');
        }else{
            if(strpos($basefile, "/") !== false){
                $filenames = explode("/", $basefile);
                if(!empty($filenames) && is_array($filenames)){
                    $filename = end($filenames);
                    if(file_exists((get_template_directory() . '/views/blocks/' . $filename . '.phtml'))){
                        require(get_template_directory() . '/views/blocks/' . $filename . '.phtml');
                    }
                }
            }
        }
    }

    /**
     * Renders a Layout file out.
     * @param $basefile
     * @param array $params
     */
    public function renderLayout($basefile, $params = array()){
        if(file_exists((get_template_directory() . '/views/layouts/' . $basefile . '.phtml'))){
            require(get_template_directory() . '/views/layouts/' . $basefile . '.phtml');
        }else{
            if(strpos($basefile, "/") !== false){
                $filenames = explode("/", $basefile);
                if(!empty($filenames) && is_array($filenames)){
                    $filename = end($filenames);
                    if(file_exists((get_template_directory() . '/views/layouts/' . $filename . '.phtml'))){
                        require(get_template_directory() . '/views/layouts/' . $filename . '.phtml');
                    }
                }
            }
        }
    }

    /**
     * This is a filter callback for returning the
     * body class array.
     *
     * @param $classes
     *
     * @return array
     */
    public function handleBodyClasses($classes){
        return $this->bodyClasses;
    }

    /**
     * This is for including (enqueue) of
     * javascript files.
     *
     * @param $name
     * @param $script
     */
    public function enqueueScript($name, $script){
        wp_enqueue_script($name, get_template_directory_uri() . '/js/' . $script);
    }

    /**
     * Generates post type label attributes from
     * the post name.
     *
     * @param $post_name
     *
     * @return array
     */
    public function generatePostTypeLabels($post_name){
        $post_name = rtrim($post_name, "s");
        $post_name = str_replace(array("_", "-"), ' ', $post_name);
        return array(
            'name'               => _x(
                str_replace(array('_', '-'), ' ', ucwords($post_name) . 's'),
                'Post Type General Name', 'text_domain'
            ),
            'singular_name'      => _x(
                str_replace(array('_', '-'), ' ', ucwords($post_name)),
                'Post Type Singular Name', 'text_domain'
            ),
            'menu_name'          => __(
                str_replace(array('_', '-'), '', ucwords($post_name) . 's'),
                'text_domain'
            ),
            'parent_item_colon'  => __(
                str_replace(array('_', '-'), ' ', 'Parent ' . ucwords($post_name)),
                'text_domain'
            ),
            'all_items'          => __(
                str_replace(array('_', '-'), ' ', 'All ' . ucwords($post_name) . 's'),
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
                str_replace(array('_', '-'), ' ', 'Search ' . ucwords($post_name) . 's'),
                'text_domain'
            ),
            'not_found'          => __(
                str_replace(array('_', '-'), ' ', 'No ' . $post_name . 's found'),
                'text_domain'
            ),
            'not_found_in_trash' => __(
                str_replace(array('_', '-'), ' ', 'No ' . $post_name . 's found in Trash'),
                'text_domain'
            ),
        );
    }

    public function generateTaxonomyLabels($taxonomy){
        $labels = array(
            'name'                       => _x(ucwords($taxonomy["pname"]), $taxonomy["tname"]),
            'singular_name'              => _x(ucwords($taxonomy["sname"]), $taxonomy["tname"]),
            'search_items'               => _x('Search ' . ucwords($taxonomy["pname"]), $taxonomy["tname"]),
            'popular_items'              => _x('Popular ' . ucwords($taxonomy["pname"]), $taxonomy["tname"]),
            'all_items'                  => _x('All ' . ucwords($taxonomy["pname"]), $taxonomy["tname"]),
            'parent_item'                => _x('Parent ' . $taxonomy["sname"], $taxonomy["tname"]),
            'parent_item_colon'          => _x('Parent ' . $taxonomy["sname"] . ':', $taxonomy["tname"]),
            'edit_item'                  => _x('Edit ' . $taxonomy["sname"], $taxonomy["tname"]),
            'update_item'                => _x('Update ' . $taxonomy["sname"], $taxonomy["tname"]),
            'add_new_item'               => _x('Add New ' . $taxonomy["sname"], $taxonomy["tname"]),
            'new_item_name'              => _x('New ' . $taxonomy["sname"], $taxonomy["tname"]),
            'separate_items_with_commas' => _x('Separate ' . $taxonomy["pname"] . ' with commas', $taxonomy["tname"]),
            'add_or_remove_items'        => _x('Add or remove ' . ucwords($taxonomy["pname"]), $taxonomy["tname"]),
            'choose_from_most_used'      => _x('Choose from most used ' . ucwords($taxonomy["pname"]), $taxonomy["tname"]),
            'menu_name'                  => _x(ucwords($taxonomy["pname"]), $taxonomy["tname"]),
        );
        return $labels;
    }

    /**
     * Get's a post excerpt by the post id.
     * @param $post_id
     *
     * @return string
     */
    function get_excerpt_by_id($post_id){
        $the_post       = get_post($post_id); //Gets post ID
        $the_excerpt    = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
        $excerpt_length = 35; //Sets excerpt length by word count
        $the_excerpt    = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
        $words          = explode(' ', $the_excerpt, $excerpt_length + 1);
        if(count($words) > $excerpt_length){
            array_pop($words);
            array_push($words, '…');
            $the_excerpt = implode(' ', $words);
        }
        $the_excerpt = '<p>' . $the_excerpt . '</p>';
        return $the_excerpt;
    }

    /**
     * This returns an accurate count of posts in a taxonomy.
     * Wordpress count only applies to the current taxonomy term,
     * and not the children of that term.
     *
     * @param $id       - Term ID.
     * @param $taxonomy - Taxonomy Name
     *
     * @return int
     */
    public function getCorrectPostCount($id, $taxonomy){
        $count     = 0;
        $args      = array('child_of' => $id);
        $tax_terms = get_terms($taxonomy, $args);
        foreach($tax_terms as $tax_term){
            if($tax_term->parent == $id){
                $count += $tax_term->count;
            }
        }
        return $count;
    }

    /**
     * Generates the rewrite attributes from the
     * post name.
     *
     * @param $post_name
     *
     * @return array
     */
    public function generatePostTypeRewrite($post_name){
        return array(
            'slug'       => $post_name,
            'with_front' => false,
            'pages'      => true,
            'feeds'      => true,
        );
    }

    /**
     * Gets the full URL of the current page
     * it is called on.
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

    /**
     * displays print_r's in a more creative way.
     * @param $val
     */
    public function debug($val){
        //$callInfo = debug_backtrace();
        $styles = array(
            'padding: 5px',
            'background: #ffcc00',
            'font-size: 120%',
            'line-height: 140%',
            'margin-top: 1em',
            'overflow: auto',
            'position: relative',
            'zoom: 1;',
            'display: block',
            'word-break: break-all',
            'word-wrap: break-word',
            'white-space: pre-wrap',
            'border: 1px solid rgba(0, 0, 0, 0.15)',
            'border-radius: 4px',
            'color: #333333',
        );
        echo '<pre style="' . implode(';', $styles) . '">';
        print_r($val);
        echo "</pre>";
    }

    /**
     * Helper function to get escaped field from ACF
     * and also normalize values.
     *
     * @param $field_key
     * @param bool $post_id
     * @param bool $format_value
     * @param string $escape_method esc_html / esc_attr or NULL for none
     * @return array|bool|string
     */
    function get_field_escaped($field_key, $post_id = false, $format_value = true, $escape_method = 'esc_html'){
        $field = get_field($field_key, $post_id, $format_value);
        /* Check for null and falsy values and always return space */
        if($field === null || $field === false){
            $field = '';
        }
        /* Handle arrays */
        if(is_array($field)){
            $field_escaped = array();
            foreach($field as $key => $value){
                $field_escaped[$key] = ($escape_method === null) ? $value : $escape_method($value);
            }
            return $field_escaped;
        }else{
            return ($escape_method === null) ? $field : $escape_method($field);
        }
    }

    /**
     * Helper function to get escaped field from ACF
     * and also normalize values.
     * This prints the field however.
     *
     * @param $field_key
     * @param bool $post_id
     * @param bool $format_value
     * @param string $escape_method esc_html / esc_attr or NULL for none
     * @return array|bool|string
     */
    function the_field_escaped($field_key, $post_id = false, $format_value = true, $escape_method = 'esc_html'){
        $field = get_field($field_key, $post_id, $format_value);
        if($field === null || $field === false){
            $field = '';
        }
        if(is_array($field)){
            $field_escaped = array();
            foreach($field as $key => $value){
                $field_escaped[$key] = ($escape_method === null) ? $value : $escape_method($value);
            }
            $return = $field_escaped;
        }else{
            $return = ($escape_method === null) ? $field : $escape_method($field);
        }
        echo $return;
    }

    /**
     * Helper function to get escaped field from ACF
     * and also normalize values.
     *
     * @param $field_key
     * @param bool $format_value
     * @param string $escape_method esc_html / esc_attr or NULL for none
     * @return array|bool|string
     */
    function get_sub_field_escaped($field_key, $format_value = true, $escape_method = 'esc_html'){
        $field = get_sub_field($field_key, $format_value);
        /* Check for null and falsy values and always return space */
        if($field === null || $field === false){
            $field = '';
        }
        /* Handle arrays */
        if(is_array($field)){
            $field_escaped = array();
            foreach($field as $key => $value){
                $field_escaped[$key] = ($escape_method === null) ? $value : $escape_method($value);
            }
            return $field_escaped;
        }else{
            return ($escape_method === null) ? $field : $escape_method($field);
        }
    }

    /**
     * Helper function to get escaped field from ACF
     * and also normalize values.
     * This prints the field however.
     *
     * @param $field_key
     * @param bool $post_id
     * @param bool $format_value
     * @param string $escape_method esc_html / esc_attr or NULL for none
     * @return array|bool|string
     */
    function the_sub_field_escaped($field_key, $format_value = true, $escape_method = 'esc_html'){
        $field = get_sub_field($field_key, $format_value);
        if($field === null || $field === false){
            $field = '';
        }
        if(is_array($field)){
            $field_escaped = array();
            foreach($field as $key => $value){
                $field_escaped[$key] = ($escape_method === null) ? $value : $escape_method($value);
            }
            $return = $field_escaped;
        }else{
            $return = ($escape_method === null) ? $field : $escape_method($field);
        }
        echo $return;
    }

    /**
     * Add's an error to the stack.
     * @param $error
     */
    public function addError($error){
        $this->errors[] = $error;
    }

    /**
     * Gets a readable list of errors.
     * @return bool|string
     */
    public function getErrors(){
        if(!empty($this->errors)){
            $return_text = '';
            foreach($this->errors AS $error){
                $return_text = $error . "\n";
            }
            return $return_text;
        }else{
            return false;
        }
    }

    /**
     * Logs the errors, into the apache
     * error log.
     */
    protected function logErrors(){
        if(!empty($this->errors) && $this->log_errors){
            error_log($this->getErrors());
        }
    }

    /**
     * Gives you a count of the errors in
     * the stack.
     * @return int
     */
    public function countErrors(){
        return count($this->errors);
    }
}
