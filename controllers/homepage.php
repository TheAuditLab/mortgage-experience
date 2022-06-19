<?php
require_once(get_template_directory() . "/libs/client/base.php");

/**
 * Class homepage
 * Handles the displaying of the homepage,
 * as well as any additional functionality
 */
class homepage extends CL_Base {
    /**
     * Construct for the controller
     *
     * @param null $body
     */
    public function __construct($body = null) {
        // Just necessary DO NOT REMOVE.
        parent::__construct();

        // Add any body classes passed
        if (!empty($body)) {
            $this->addBodyClasses($body);
        }

        // Include any helpers you need for the views
        // Within the page controller.
        $this->addViewHelpers(array('Data', 'Image', 'Menu'));
        // Include the relevant view file.
        // Basically we are using the file name of this file
        // To generate the include. So homepage.php
        $this->addIncludes(basename(__FILE__), true);
    }
}