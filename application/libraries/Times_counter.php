<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Times_counter {

    private $hou = 0;
    private $min = 0;
    private $sec = 0;
    private $totaltime = '00:00:00';

    public function get_total_time($times){
		/*if(is_array($times)){
	    $length = sizeof($times);

	    for($x=0; $x <= $length; $x++){
	    $split = explode(":", @$times[$x]);
	    $this->hou += @$split[0];
	    $this->min += @$split[1];
	    $this->sec += @$split[2];
	    }

	    $seconds = $this->sec % 60;
	    $minutes = $this->sec / 60;
	    $minutes = (integer)$minutes;
	    $minutes += $this->min;
	    $hours = $minutes / 60;
	    $minutes = $minutes % 60;
	    $hours = (integer)$hours;
	    //$hours += $this->hou % 24;
		  $hours += $this->hou;
	    $this->totaltime = $hours." ".lang("JOBASSIGN-REPORT::hour")." ".$minutes." ".lang("JOBASSIGN-REPORT::minute");
	    }*/
        foreach ($times as $time) {
                list($hour, $minute) = explode(':', $time);
                $minutes += $hour * 60;
                $minutes += $minute;
        }

                $hours = floor($minutes / 60);
                $minutes -= $hours * 60;
                 $this->totaltime = $hours." ".lang("JOBASSIGN-REPORT::hour")." ".$minutes." ".lang("JOBASSIGN-REPORT::minute"); 
                return $this->totaltime;
	 }

    }
?>
