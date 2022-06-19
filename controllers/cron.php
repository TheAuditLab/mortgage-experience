<?php
require_once(get_template_directory() . "/libs/client/base.php");

/**
 * Class cron
 * For controlling cron's needed for the project
 */
class cron extends CL_Base {

    /**
     * Construct the classes
     * and setup the actions/fliters.
     */
    public function __construct(){
        parent::__construct();

        $this->schedule_events();

        add_filter('cron_schedules', array($this, 'new_intervals'));
    }

    /**
     * Assigns the scheduled events.
     */
    public function schedule_events(){
        $this->addEvent('hourly_events', 'hourly', 'hourly_events');
        $this->addEvent('daily_events', 'daily', 'daily_events');
        $this->addEvent('weekly_events', 'weekly', 'weekly_events');
    }

    /**
     * Shortcode to generate a new cron event.
     * @param $event_name
     * @param $timing
     * @param $function_name
     */
    public function addEvent($event_name, $timing, $function_name){
        add_action($event_name, array($this, $function_name));
        if(!wp_next_scheduled($event_name)){
            wp_schedule_event(current_time('timestamp'), $timing, $event_name);
        }
    }

    /**
     * Do things hourly here.
     */
    public function hourly_events(){

    }

    /**
     * Do daily events here.
     */
    public function daily_events(){

    }

    /**
     * Do weekly events.
     */
    public function weekly_events(){

    }

    /**
     * Adding monthly and weekly interval options for crons.
     * @param $schedules
     * @return mixed
     */
    public function new_intervals($schedules){
        // add weekly and monthly intervals
        $schedules['weekly'] = array(
            'interval' => 604800,
            'display' => __('Once Weekly')
        );

        $schedules['monthly'] = array(
            'interval' => 2635200,
            'display' => __('Once a month')
        );

        return $schedules;
    }

}