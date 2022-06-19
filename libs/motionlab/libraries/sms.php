<?php
require_once(get_template_directory() . "/libs/motionlab/libraries/baseLibrary.php");

/**
 * Class ML_sms
 * This is a class for sending SMS messages via
 * txtlocal. This is abstract and should be extended to
 * allow you to implement into the correct methods within
 * your project.
 */
abstract class ML_sms extends ML_baseLibrary{
    // API Connection details
    protected $_apiUrl = 'https://api.txtlocal.com/send/?';
    protected $_username = 'andy.windle@motionlab.co.uk';
    protected $_hash = '4a2436b456b1a2b5c243377bb3a97b2566bb35aa'; // Get this when logged in at https://control.txtlocal.co.uk/docs/

    // Numbers to send to
    protected $_numbers;

    // Testing mode
    protected $_testing = true;

    public function __construct($api_url=null, $api_user=null, $api_hash=null){
        if(!empty($api_url)){
            $this->_apiUrl = $api_url;
        }
        if(!empty($api_user)){
            $this->_username = $api_user;
        }
        if(!empty($api_hash)){
            $this->_hash = $api_hash;
        }
    }

    /**
     * Sends an SMS message.
     * @param array  $numbers
     * @param null   $message
     * @param string $sender
     * @return bool
     */
    function sendSms($numbers = array(), $message = null, $sender = 'Motionlab') {
        if(empty($numbers) || !isset($message)) {
            return false;
        }

        if($this->_testing) {
            $numbers = array('07921586734'); // Just for testing so we don't do anything stupid like txt a customer
        }
        $this->_setNumbers($numbers);
        $sender = urlencode($sender);
        $message = rawurlencode($message);

        $data = $this->_setApiData($numbers, $sender, $message);
        $request = $this->_apiUrl . $data;

        if($this->_curlRequest($request)) {
            return true;
        }

        return false;
    }

    /**
     * setApiData
     *
     * @param mixed $numbers
     * @param mixed $sender
     * @param mixed $message
     * @return string $data
     */
    private function _setApiData($numbers, $sender, $message) {
        $data = 'username=' . $this->_username .
            '&hash=' . $this->_hash .
            '&numbers=' . $this->_numbers .
            "&sender=" . $sender .
            "&message=" . $message;

        return $data;
    }

    /**
     * setNumbers
     *
     * Makes sure the numbers are formatted correctly to send an SMS
     *
     * @param string $numbers
     */
    private function _setNumbers($numbers) {
        $numbers = implode(',', $numbers);
        $numbers = str_replace(' ', '', $numbers);
        $numbers = urlencode($numbers);
        $this->_numbers = $numbers;
    }

    /**
     * curlRequest
     *
     * Simply initiates the culrRequest
     *
     * @param mixed $request
     * @return mixed
     */
    private function _curlRequest($request) {
        $ch = curl_init($request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}