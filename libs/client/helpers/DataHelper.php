<?php
/**
 * Class DataHelper
 * This class extends the base data helper.
 * It can be used to add client specific data helpers
 * or overwrite specific ones for the client.
 */
require_once(get_template_directory() . "/libs/motionlab/helpers/DataHelper.php");

class CL_DataHelper extends ML_DataHelper {

    /**
    * dateFormat
    * 
    * Formats a UK date (d/m/Y) to display format 
    * used on site dS F Y
    * 
    * Eg 19/3/2015 => 19th March 2015
    * 
    * @param string $date
    * @return string
    */
    public function dateFormat($date) {
        $date = str_replace('/', '-', $date); 
        $date = date('jS F Y', strtotime($date));
        return $date;   
    }
    
    /**
    * put dateTimeStringFormat comment there...
    * 
    * Formats a UK date (d/m/Y) and time (0:00 AM) to 
    * string display format used on site (Y-m-dTH:i)
    * 
    * Eg 19/3/2015 07:30 PM => 2015-03-19T19:30
    * 
    * @param mixed $date
    * @param mixed $time
    * @return string
    */
    public function dateTimeStringFormat($date, $time = '0:00 AM') {
        $date = str_replace('/', '-', $date);
        $dateTime = strtotime($date . ' ' . $time);
        $dateString = date('Y-m-d', $dateTime);
        $dateString .= 'T' . date('H:i', $dateTime);
        return $dateString;
    }

}