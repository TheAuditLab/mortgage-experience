<?php
require_once(get_template_directory() . "/libs/motionlab/libraries/sms.php");

/**
 * Class CL_sms
 * Client specific extension to the Motionlab
 * sms library for controlling and implementing
 * specifically for this project.
 */
class CL_sms extends ML_sms{
    // API Connection details
    protected $_apiUrl = 'https://api.txtlocal.com/send/?';
    protected $_username = 'andy.windle@motionlab.co.uk';
    protected $_hash = '4a2436b456b1a2b5c243377bb3a97b2566bb35aa'; // Get this when logged in at https://control.txtlocal.co.uk/docs/

    // Numbers to send to
    protected $_numbers;

    // Testing mode
    protected $_testing = true;

    public function __construct($numbers = array(), $message = null, $sender = 'Realm'){
        parent::__construct($this->_apiUrl, $this->_username, $this->_hash);

        if(!empty($numbers) && !empty($message)) {
            parent::sendSms($numbers, $message, $sender);
        }
    }
}