<?php

class BoardModel {
    
    private $cells;
    
    private $smallBoard;
    
    private $active;
    
    public function __construct ($smallBoard) {
        $this->smallBoard = $smallBoard;
        $this->cells = $this->generateCells();
        $this->active = true;
    }
    
    public function isSmallBoard() {
        return $this->smallBoard;
    }
    
    public function getCells() {
        return $this->cells;
    }
    
    // Returns an array that represents the whole board
    public function getWholeBoard() {
        if($this->smallBoard) {
            $this->getCells();
        } else {
            $wholeBoard = array();
            foreach($this->getCells() as $key => $value) {
                $wholeBoard[$key] = $this->getCells()[$key]->getCells();
            }
            return $wholeBoard;
        }
    }
    
    public function setCellState($index, $newState) {
        if ($this->cells[$index] ==="" && ($newState === 0 || $newState === 1)) {
            $this->cells[$index] = $newState;
            return true;
        }
        else {
            return false;
        }
    }
    
    private function generateCells() {
        $cells = array();
        for($i = 1; $i <= 9; $i++) {
            array_push($cells, $this->smallBoard ? "" : new BoardModel(true));
        }
        return $cells;
    }
    
    // Need to create a method that disables portions of the board.
}


?>

