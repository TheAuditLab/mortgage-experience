<?php
require_once(get_template_directory() . "/libs/client/base.php");

/**
 * Class page404
 * Handles the displaying of the 404 page,
 * as well as any additional functionality
 */
class ajax extends CL_Base
{
    /**
     * Construct for the controller
     *
     * @param null $body
     */
    public function __construct($body = null)
    {
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

    /**
     * Saves the newsletter details.
     */
    public function save()
    {
        $error = false;
        if(!isset($_REQUEST['download_id'])){
            $error = true;
        }
        if (isset($_REQUEST["email"])) {
            $email = sanitize_text_field(urldecode($_GET['email']));
        }else{
            $error = true;
        }
        if (isset($_REQUEST["subname"])) {
            $name = sanitize_text_field($_GET['subname']);
        }else{
            $error = true;
        }
        if(!$error) {
            $entry_id = GFAPI::add_entry(array(
                "form_id" => 3,
                "1" => $name,
                "2" => $email
            ));

            if (!is_wp_error($entry_id)) {
                $this->send_notifications(3, $entry_id);

                $attachment = wp_get_attachment_url($_GET['download_id']);
                if(!empty($attachment)){
                    echo esc_url($attachment);
                }
            } else {
                echo 'false - no entry made';
            }
        }else{
            echo 'false - missing field';
        }
    }

    /**
     * Send Notifications for gravity forms.
     * @param int $form_id
     * @param int $entry_id
     */
    public function send_notifications($form_id, $entry_id)
    {
        // Get the array info for our forms and entries
        // that we need to send notifications for
        $form = RGFormsModel::get_form_meta($form_id);
        $entry = RGFormsModel::get_lead($entry_id);

        // Loop through all the notifications for the
        // form so we know which ones to send
        $notification_ids = array();
        foreach ($form['notifications'] as $id => $info) {
            array_push($notification_ids, $id);
        }

        // Send the notifications
        GFCommon::send_notifications($notification_ids, $form, $entry);
    }
}