<?php
/**
 * Class DataHelper
 * This class is a series of helper methods
 * to be used in view templates
 */

class ML_DataHelper {
    /**
     * Format text content
     * Formating includes wrapping, adding prefix and adding suffix
     *
     * @param string $content
     * @param array  $options
     *
     * @return string $content
     */
    public function text ($content, $options = array()) {
        if(trim($content) == '') {
            return $content;
        }

        if(isset($options['prefix'])) {
            $content = $this->elementPrefix($content, $options['prefix']);
        }

        if(isset($options['suffix'])) {
            $content = $this->elementSuffix($content, $options['suffix']);
        }

        if(isset($options['element-wrap'])) {
            $content = $this->elementWrap($content, $options['element-wrap']);
        }

        return $content;
    }

    /**
     * Wrap content with html elements
     *
     * @param string $content
     * @param mixed  $element
     *
     * @return string $content
     */
    public function elementWrap ($content, $element = "p") {
        if(is_array($element)) {
            foreach($element as $item) {
                $options = explode('.', $item);
                $class   = (isset($options[1])) ? ' class="' . $options[1] . '"' : null;
                $content = "<" . $options[0] . $class . ">" . $content . "</" . $options[0] . ">";
            }
        } else {
            $options = explode('.', $element);
            $class   = (isset($options[1])) ? ' class="' . $options[1] . '"' : null;
            $content = "<" . $options[0] . $class . ">" . $content . "</" . $options[0] . ">";
        }

        return $content;
    }

    /**
     * Prefix content
     *
     * @param string $content
     * @param string $prefix
     */
    public function elementPrefix ($content, $prefix) {
        return $prefix . $content;
    }

    /**
     * Suffix content
     *
     * @param string $content
     * @param string $suffix
     */
    public function elementSuffix ($content, $suffix) {
        return $content . $suffix;
    }

    /**
     * Wraps the last word with a span.
     * @param        $text
     * @param string $class
     * @param null   $style
     *
     * @return string
     */
    public function wrapLastWord ($text, $class = "tc-colour", $style = null) {
        $wordarray = explode(' ', $text);
        if(count($wordarray) > 1) {
            $wordarray[count($wordarray) - 1] = '<span class="' . $class . '" style="' . $style . '">' . ($wordarray[count($wordarray) - 1]) . '</span>';
            $text                             = implode(' ', $wordarray);
        }

        return $text;
    }

    /**
     * Wrap the last line with a span.
     * @param        $text
     * @param string $class
     * @param null   $style
     *
     * @return string
     */
    public function wrapLastLine ($text, $class = "tc-colour", $style = null) {
        $text_array = explode("<br />", $text);

        $return_text = "";
        if( ! empty($text_array)) {
            $total = count($text_array);
            $i     = 1;
            foreach($text_array AS $item) {
                if($i == $total) {
                    $return_text .= '<span class="' . $class . '" style="' . $style . '">' . $item . '</span>';
                } else {
                    $return_text .= '<span>' . $item . '</span>';
                }
                $i ++;
            }
        }

        return $return_text;
    }

    /**
     * Character limt that ends on full words.
     * So it will never crop a word.
     *
     * @param $string
     * @param $width
     *
     * @return string
     */
    public function limitCharacter ($string, $width) {
        if(strlen($string) > $width) {
            $string = wordwrap($string, $width);
            $string = substr($string, 0, strpos($string, "\n"));
        }

        return $string;
    }

    /**
     * Sorts a post object array into an order based
     * off it's IDs.
     * @param $posts
     * @param $order
     *
     * @return array
     */
    public function sortIntoSpecific ($posts, $order) {
        $i         = 0;
        $new_array = array();
        foreach($order AS $id) {
            foreach($posts AS $post) {
                if($id == $post->ID) {
                    $new_array[$i] = $post;
                    $i ++;
                }
            }
        }

        return $new_array;
    }
}