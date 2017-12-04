<?php

class BoardModel {
    
    private $cells;
    
    private $smallBoard;
    
    public function __construct ($smallBoard) {
        $this->smallBoard = $smallBoard;
        $this->cells = $this->generateCells();
    }
    
    public function isSmallBoard() {
        return $this->smallBoard;
    }
    
    public function getCells() {
        return $this->cells;
    }
    
    public function setCellState($index, $newState) {
        
        if ($this->cells[$index] ==="" && ($newState === 0 || $newState === 1)) {
            $this->cells[$index] = $newState;
        }
    }
    
    private function generateCells() {
        $cells = array();
    
        for($i = 1; $i <= 9; $i++) {
            array_push($cells, $this->smallBoard ? "" : new BoardModel(true));
        }
        return $cells;
    }
    
    
    
}


?>

