<?php
/**
 * For video related functionality.
 * Class ML_VideoHelper
 */
class ML_VideoHelper{

    /**
     * Get object from Vimeo from the URL.
     *
     * @note Uses CURL.
     * @param $url
     *
     * @return SimpleXMLElement
     */
    public function getVimeo ($url) {
        $oembed_endpoint = 'http://vimeo.com/api/oembed';

        // Grab the video url from the url, or use default
        $video_url = ($url) ? $url : 'http://vimeo.com/7100569';

        // Create the URLs
        $xml_url    = $oembed_endpoint . '.xml?url=' . rawurlencode($video_url) . '&width=943';

        // Do the CURL request.
        $curl = curl_init($xml_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        $xml_string = curl_exec($curl);
        curl_close($curl);

        // Load in the oEmbed XML
        if(!empty($xml_string)) {
            $oembed = simplexml_load_string($xml_string);

            return $oembed;
        }else{
            return false;
        }
    }

    public function getYoutubeID($url){
        if(strpos($url, 'youtube') !== false){
            preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);

            if(!empty($matches) && is_array($matches)){
                return $matches[0];
            }else{
                return $matches;
            }

        }else{
            return false;
        }
    }

    public function getYoutubeEmbed($url){
        $id = $this->getYoutubeID($url);

        if(!$id){
            return false;
        }else{
            return "https://www.youtube.com/embed/".$id;
        }
    }

}