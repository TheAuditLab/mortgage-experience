<?php
/**
 * Class ML_ImageHelper
 * Handles image data manipulation
 */
class ML_ImageHelper {
    /**
     * Get's a specific image data object.
     * @param $image
     * @param $data
     *
     * @return mixed
     */
    public function getImageData($image, $data){
        return $image[$data];
    }

    /**
     * Get's a resized image from an image array.
     * Then either resizes using timthumb, or if
     * the image attachment size has been created in
     * Wordpress, and the attachment size identifier has been
     * passed, use that.
     *
     * @param array $image
     * @param int $width
     * @param bool $height
     * @param string $attachment_size
     *
     * @return string
     */
    public function getResizedImage($image, $width = 500, $height = false, $attachment_size = ''){
        // If we pass through an attachment ID deal with it.
        if(is_int($image)){
            if(!empty($attachment_size)){
                $image = $this->getImageFromID((int)$image);
            }else{
                $image = $this->getUrlFromID((int)$image);
            }
        }

        if(!empty($attachment_size)){
            if(is_array($image)) {
                return esc_url($image['sizes'][$attachment_size]);
            }
        }else{
            if(!is_array($image)){
                return $this->resizeImage($image, $width, $height);
            }else{
                return $this->resizeImage($this->getImageData($image, 'url'), $width, $height);
            }
        }
    }

    /**
     * Generates the correct timthumb url path.
     * @param string $imgUrl
     * @param int $width
     * @param bool $height
     *
     * @return string
     */
    public function resizeImage($imgUrl = '', $width = 500, $height = false){
        $params = 'src=' . $imgUrl . '&w=' . $width . ($height ? '&h=' . $height : '');

        return esc_url('/scripts/timthumb.php?' . $params);
    }

    /**
     * Get's the image object from the
     * attachment ID.
     * @param $id
     * @return bool|string
     */
    public function getImageFromID($id){
        if(!is_int($id)){
            return false;
            exit;
        }
        $meta = wp_get_attachment_metadata($id);

        return $meta;
    }

    /**
     * Removes the site from the image name.
     * This is used in multisites.
     * @param $image
     * @return string
     */
    function getSitelessImage($image){
        $url_pieces = explode("/", $image);
        $img_string = "";
        foreach($url_pieces AS $id => $piece){
            if(!empty($piece)){
                if($id == 0){
                    $img_string .= $piece . "//";
                }elseif($id != 3){
                    if($id != (count($url_pieces) - 1)){
                        $img_string .= $piece . "/";
                    }else{
                        $img_string .= $piece;
                    }
                }
            }
        }

        return $img_string;
    }

    /**
     * Get's an image url from the attachment
     * ID
     * @param $id
     * @return mixed
     */
    public function getUrlFromID($id, $no_http=false){
        if(!is_int($id)){
            return false;
            exit;
        }
        $image = wp_get_attachment_image_src($id, 'full');
        return esc_url($image[0]);
    }

}