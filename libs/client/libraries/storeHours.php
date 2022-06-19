<?php
require_once(get_template_directory() . "/libs/motionlab/libraries/storeHours.php");

/**
 * Class Cl_storeHours
 * For overwriting the abstracts in ML_storeHours
 * for client specific rendering
 */
class Cl_storeHours extends ML_storeHours {

    function __construct($hours = array(), $exceptions = array(), $template = array()) {
        parent::__construct($hours, $exceptions, $template);
    }

    public function render_mini_html($group_array, $classes = 'no-style'){
        $return = "";
        $return .= '<table class="' . $classes . '">';
        foreach ($group_array AS $group) {
            $return .= '<tr>';
            $first = key($group);

            $index = 0;
            $hours_template = '';

            foreach ($group[$first] as $range) {
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

            if (count($group) > 1) {
                foreach($group AS $day => $results){
                    if(empty($results)){
                       unset($group[$day]);
                    }
                }

                $last = end(array_keys($group));
                if(count($group) > 2){
                    $day = $this->full_day[$first] . " - " . $this->full_day[$last];
                }else{
                    $day = $this->full_day[$first] . " &amp; " . $this->full_day[$last];
                }
            } else {
                $day = $this->full_day[$first];
            }

            if(!empty($hours_template)){
                $return .= '<th>' . $day . ':</th>';
                $return .= '<td>' . $hours_template . '</td>';
                $return .= '</tr>';
            }
        }
        $return .= '</table>';;

        return $return;
    }

    /**
     * Overwriting ML_storeHours::render_mini()
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

                    $i++;
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

    public function render_full_html($content, $day, $val){
        return '<span itemprop="openingHours" content="' .$content. '">
                     <strong>' . $day . '</strong> ' . $val . '
                </span>';
    }

}