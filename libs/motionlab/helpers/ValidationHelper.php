<?php
/**
 * To be used for validation checks.
 * Class ML_ValidationHelper
 */
class ML_ValidationHelper {

    /**
     * Validates that a postcode is the correct format.
     * @param $postcode
     *
     * @return bool
     */
    function IsPostcode ($postcode) {
        $postcode = strtoupper(str_replace(' ', '', $postcode));
        if(preg_match("/^[A-Z]{1,2}[0-9]{2,3}[A-Z]{2}$/", $postcode)
           || preg_match("/^[A-Z]{1,2}[0-9]{1}[A-Z]{1}[0-9]{1}[A-Z]{2}$/", $postcode)
           || preg_match("/^GIR0[A-Z]{2}$/", $postcode)) {
            return true;
        } else {
            return false;
        }
    }

}