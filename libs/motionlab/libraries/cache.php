<?php
require_once(get_template_directory() . "/libs/motionlab/libraries/baseLibrary.php");
/**
 * Class ML_cache
 * The purpose of this library is to
 * hopefully allow some fragment
 * caching to Wordpress.
 * Using the default Wordpress Object Cache API.
 * This requires a Persistent Cache Plugin to store
 * the cache to a filesystem.
 * @see https://codex.wordpress.org/Class_Reference/WP_Object_Cache
 */
class ML_cache extends ML_baseLibrary{
    // How to classify the cache we are making.
    const GROUP = 'ml_cache';
    // The key of the cache record.
    private $key;
    // The expiry time of the record.
    private $expire = 0;

    /**
     * Class construct
     * can be used to set the key or expiry.
     *
     * @param null $key
     * @param null $expire
     */
    public function __construct($key = null, $expire = null){
        if(!empty($key)){
            $this->key = $key;
        }
        if(!empty($expire)){
            $this->expire = $expire;
        }
    }

    /**
     * Output for HTML.
     * If a key hasn't been set in a constructor it can be set
     * in the parameters.
     *
     * Always check to make sure you get a value returned.
     * if not then generate your input as normal and run
     * the store function. If you do not do this, your
     * application will break.
     *
     * @see store();
     * @param null $key
     * @return bool|string
     */
    public function output($key = null){
        if(!empty($key)){
            $this->key = $key;
        }
        if(empty($this->key)){
            return false;
        }
        $output = wp_cache_get($this->key, self::GROUP);
        if(!empty($output)){
            // It was in the cache
            echo $output;
            return true;
        }
    }

    /**
     * To be used after output
     * @see output()
     * @param null $expire
     * @return bool
     */
    public function store($expire = null){
        if(!empty($expire)){
            $this->expire = $expire;
        }
        if(empty($this->key)){
            return false;
        }
        $output = ob_get_clean(); // Flushes the buffers
        wp_cache_add($this->key, $output, self::GROUP, $this->expire);
        ob_end_flush();

        echo $output;
    }

    /**
     * Outputs the cache of a particular
     * function or caches it.
     * @param $function
     * @param null $key
     * @param null $expire
     * @return bool
     */
    public function output_function($function, $key = null, $expire = null){
        if(!empty($key)){
            $this->key = $key;
        }
        if(!empty($expire)){
            $this->expire = $expire;
        }
        if(empty($this->key)){
            return false;
        }
        $output = wp_cache_get($this->key, self::GROUP);
        if(empty($output)){
            ob_start();
            call_user_func($function);
            $output = ob_get_clean();
            wp_cache_add($this->key, $output, self::GROUP, $this->expire);
        }
        echo $output;
    }
}