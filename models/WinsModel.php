<?php 

class WinsModel {
    
    private $counters = array(
        row1 => 0,
        row2 => 0,
        row3 => 0,
        col1 => 0,
        col2 => 0,
        col3 => 0,
        dia1 => 0,
        dia2 => 0
    );
    
    private $total = 0;
    
    public function getTotal(){
        return $this->total;
    }
    
    public function checkForWin($coord){
        $this->total++;
        $coord = (int)$coord;
        
        if ($coord === 0 || $coord === 1 || $coord === 2) {
            $this->counters["row1"]++;
        }
        if ($coord === 3 || $coord === 4 || $coord === 5) {
            $this->counters["row2"]++;
        }
        if ($coord === 6 || $coord === 7 || $coord === 8) {
            $this->counters["row3"]++;
        }
        if ($coord === 0 || $coord === 3 || $coord === 6) {
            $this->counters["col1"]++;
        }
        if ($coord === 1 || $coord === 4 || $coord === 7) {
            $this->counters["col2"]++;
        }
        if ($coord === 2 || $coord === 5 || $coord === 8) {
            $this->counters["col3"]++;
        }
        if ($coord === 0 || $coord === 4 || $coord === 8) {
            $this->counters["dia1"]++;
        }
        if ($coord === 2 || $coord === 4 || $coord === 6) {
            $this->counters["dia2"]++;
        }
        
        foreach($this->counters as $key => $value) {
            if ($value === 3) {
                unset($value, $key);
                return true;
            }
        }
        unset($value, $key);
        return false;
    }
}
?>