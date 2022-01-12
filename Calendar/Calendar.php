<?php
class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function add_event($txt, $timeslot, $date, $days = 1, $color = '', $link) {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $timeslot,  $date, $days, $color, $link];
    }

    public function __toString() {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));

        //laat deze code (2 regels) hieronder staan anders krijg je issues omdat dit met opgehaalde info werkt.
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        //$first_day_of_week--; // decrement day of week
        //$days = [0 => 'Mon', 1 => 'Tue', 2 => 'Wed', 3 => 'Thu', 4 => 'Fri', 5 => 'Sat', 6 => 'Sun'];

        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days">';
        foreach ($days as $day) {
            //if (!($day == 'Sat' or $day == 'Sun')){
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
          //}
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day) {
                $selected = ' selected';
            }
            //if ($i%7!=$first_day_of_week) {
              $html .= '<div class="day_num' . $selected . '">';
              $html .= '<span>' . $i . '</span>';
              //wat betekenen de nummers hieronder in de $event[<hier>]? hier de array die defined werd bovenin dit bestand
              //$this->events[] = [0 = $txt, 1 = $timeslot, 2 = $date, 3 = $days, 4 = $color, 5 = $link];
              foreach ($this->events as $event) {
                  for ($d = 0; $d <= ($event[3]-1); $d++) {
                      if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[2]))) {
                        	$html .= '<a href="' . $event[5] . '" class="event' . $event[4] . '">';
                        	$html .= $event[0];
                        	$html .= '</a>';
                          $html .= $event[1];
                      }
                  }
              }
              $html .= '</div>';
            //}
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}
?>
