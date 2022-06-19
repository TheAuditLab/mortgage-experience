<?php
require_once(get_template_directory() . "/libs/motionlab/libraries/baseLibrary.php");

/**
 * Class ML_storeHours
 * This is for displaying store hours.
 * This is abstract so you can extend onto
 * your own classes to add your own format
 * for rendering.
 */
abstract class ML_storeHours extends ML_baseLibrary{
    public $hours;
    public $exceptions;
    public $template;
    public $full_day = array(
        'sun' => 'Sunday*',
        'mon' => 'Monday',
        'tue' => 'Tuesday',
        'wed' => 'Wednesday',
        'thu' => 'Thursday',
        'fri' => 'Friday',
        'sat' => 'Saturday'
    );

    /**
     * Construct
     * @param array $hours
     * @param array $exceptions
     * @param array $template
     */
    function __construct($hours = array(), $exceptions = array(), $template = array()) {
        $this->hours = $hours;
        $this->exceptions = $exceptions;
        $this->template = $template;
        if (!isset($this->template['open'])) {
            $this->template['open'] = "<h3>Yes, we're open! Today's hours are {%hours%}.</h3>";
        }
        if (!isset($this->template['closed'])) {
            $this->template['closed'] = "<h3>Sorry, we're closed. Today's hours are {%hours%}.</h3>";
        }
        if (!isset($this->template['closed_all_day'])) {
            $this->template['closed_all_day'] = "<h3>Sorry, we're closed.</h3>";
        }
        if (!isset($this->template['separator'])) {
            $this->template['separator'] = " - ";
        }
        if (!isset($this->template['join'])) {
            $this->template['join'] = " and ";
        }
        if (!isset($this->template['format'])) {
            $this->template['format'] = "g:ia";
        }
        if (!isset($this->template['hours'])) {
            $this->template['hours'] = "{%open%}{%separator%}{%closed%}";
        }
    }

    /**
     * Returns today's hours
     * @return mixed
     */
    public function hours_today() {
        $today = strtotime('today midnight');
        $day = strtolower(date("D"));
        $hours_today = $this->hours[$day];
        if ($this->exceptions) {
            foreach ($this->exceptions as $ex_day => $ex_hours) {
                if (strtotime($ex_day) == $today) {
                    $hours_today = $ex_hours;
                }
            }
        }

        return $hours_today;
    }

    /**
     * Returns true on being open.
     * @return bool
     */
    public function is_open() {
        $now = strtotime(date("G:i"));
        $hours_today = $this->hours_today();
        $is_open = 0;
        if (!empty($hours_today[0])) {
            foreach ($hours_today as $range) {
                $range = explode("-", $range);
                $start = strtotime($range[0]);
                $end = strtotime($range[1]);
                // Add one day if the end time is past midnight
                if ($end <= $start) {
                    $end = strtotime($range[1] . ' + 1 day');
                }
                if (($start <= $now) && ($end >= $now)) {
                    $is_open++;
                }
            }
        }
        if ($is_open > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * generates the
     * @param $template_name
     */
    private function render_html($template_name) {
        $hours_today = $this->hours_today();
        $output = '';
        $index = 0;
        if (!empty($hours_today[0])) {
            $hours_template = '';
            foreach ($hours_today as $range) {
                $range = explode("-", $range);
                $start = strtotime($range[0]);
                $end = strtotime($range[1]);
                if ($index >= 1) {
                    $hours_template .= $this->template['join'];
                }
                $hours_template .= $this->template['hours'];
                $hours_template = str_replace('{%open%}', date($this->template['format'], $start), $hours_template);
                $hours_template = str_replace('{%closed%}', date($this->template['format'], $end), $hours_template);
                $hours_template = str_replace('{%separator%}', $this->template['separator'], $hours_template);
                $index++;
            }
            $output .= str_replace('{%hours%}', $hours_template, $this->template[$template_name]);
        } else {
            $output .= $this->template['closed_all_day'];
        }
        echo $output;
    }

    /**
     * Render the correct HTML out.
     */
    public function render() {
        if ($this->is_open()) {
            $this->render_html('open');
        } else {
            $this->render_html('closed');
        }
    }

    /**
     * Renders a mini list, where sequential
     * days with the same times are grouped.
     * @param string $render_type
     * @param string $classes
     */
    public function render_mini($render_type = 'table', $classes = 'no-style') {
        $days_num = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');

        if (!empty($this->hours)) {
            $correct_array = array();
            $previous = array();
            $i = 0;
            foreach ($days_num AS $id => $day) {
                $times = $this->hours[$day];

                foreach ($times AS $time) {
                    if (!empty($this->exceptions)) {
                        $today = strtotime($day . ' midnight');

                        foreach ($this->exceptions as $ex_day => $ex_hours) {
                            if (strtotime($ex_day) == $today) {
                                $i++;
                                $previous = array('');
                                $times = $ex_hours;
                                break;
                            }
                        }
                    }

                    if (!in_array($time, $previous)) {
                        $i++;
                        $previous = array();
                        break;
                    }
                }

                if (empty($previous)) {
                    $previous = $times;
                    $correct_array[$i][$day] = $times;
                } else {
                    $correct_array[$i][$day] = $times;
                }
            }
        }

        $return = $this->render_mini_html($correct_array);

        echo $return;
    }

    /**
     * This should be overwritten in the CL file
     * @param        $group_array
     * @param string $classes
     * @return mixed
     */
    abstract function render_mini_html($group_array, $classes = 'no-style');

    /**
     * Renders the full list of all days.
     * @param string $render_type
     */
    public function render_full($render_type = 'span') {
        $return = '';
        if (!empty($this->hours)) {
            foreach ($this->hours as $day => $times) {
                $index = 0;
                $hours_template = '';

                if (!empty($this->exceptions)) {
                    $today = strtotime($day . ' midnight');

                    foreach ($this->exceptions as $ex_day => $ex_hours) {
                        if (strtotime($ex_day) == $today) {
                            $times = $ex_hours;
                            break;
                        }
                    }
                }

                foreach ($times as $range) {
                    $range = explode("-", $range);
                    $start = strtotime($range[0]);
                    $end = strtotime($range[1]);
                    if ($index >= 1) {
                        $hours_template .= $this->template['join'];
                    }
                    $hours_template .= $this->template['hours'];
                    $hours_template = str_replace('{%open%}', date($this->template['format'], $start), $hours_template);
                    $hours_template = str_replace('{%closed%}', date($this->template['format'], $end), $hours_template);
                    $hours_template = str_replace('{%separator%}', $this->template['separator'], $hours_template);
                    $index++;
                }

                $return .= $this->render_full_html($day . ' ' . implode($this->template["join"] . " ", $times), $this->full_day[$day], $hours_template);


            }
        }

        echo $return;
    }

    /**
     * This should be overwritten in the CL file
     * @param $content
     * @param $day
     * @param $val
     * @return mixed
     */
    abstract function render_full_html($content, $day, $val);
}

?>