<?php
/**
 * Handles postcode related items.
 * Class ML_PostcodeHelper
 */
class ML_PostcodeHelper {
    private $gmap_api_key = "AIzaSyCz4VCgdUTxCcVRmLVET18ZNaDQKRkeBbA";

    /**
     * Uses google maps API to get Lng + Lat
     * from a postcode and country.
     * @param $postcode
     * @param $country
     *
     * @return bool|SimpleXMLElement
     */
    function getCoordsFromPostcode ($postcode, $country) {
        if(isset($this->gmap_api_key) && ! empty($this->gmap_api_key)) {
            /* remove spaces from postcode */
            $postcode = urlencode(trim($postcode));

            /* connect to the google geocode service */
            $file = "https://maps.googleapis.com/maps/api/geocode/xml?address=$postcode,$country&sensor=false&key=$this->gmap_api_key";

            $contents = file_get_contents($file);

            return simplexml_load_string($contents);
        } else {
            return false;
        }
    }

    /**
     * Calculation to generate distance between two sets
     * of coordinates.
     * @param     $latitudeFrom
     * @param     $longitudeFrom
     * @param     $latitudeTo
     * @param     $longitudeTo
     * @param int $earthRadius
     *
     * @return float
     */
    public static function vincentyGreatCircleDistance (
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000
    ) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo   = deg2rad($latitudeTo);
        $lonTo   = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a        = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b        = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);

        return ($angle * $earthRadius) / 1000;
    }
}