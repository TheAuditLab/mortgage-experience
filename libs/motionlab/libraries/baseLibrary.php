<?php

/**
 * Abstract Class ML_baseLibrary
 * This can be used to extend other libraries
 * and add cool things like debug and error handling.
 */
abstract class ML_baseLibrary{
    public $errors = array();

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