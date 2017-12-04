<?php 

class Player {
    
    public $number;
    
    public $counters = array(
        row1 => 0,
        row2 => 0,
        row3 => 0,
        col1 => 0,
        col2 => 0,
        col3 => 0,
        dia1 => 0,
        dia2 => 0
    );
    
    private $totalSquares = 0;
}

?>