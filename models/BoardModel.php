<?php

include_once 'WinsModel.php';

class BoardModel {
    
    protected $boardWinner;
    
    protected $winConditions;
    
    protected $cells;
    
    public function __construct () {
        $this->cells = $this->generateCells();
        $this->winConditions = array(new WinsModel, new WinsModel);
    }
    
    public function getCells() {
        return $this->cells;
    }
    
    // template method
    protected function generateCell() {
        throw new Exception("generateCell called in abstract base class");
    }
    
    protected function setCellState() {
        throw new Exception("setCellState called in abstract base class");
    }
    
    private function generateCells() {
        $cells = array();
        for($i = 1; $i <= 9; $i++) {
            array_push($cells, $this->generateCell());
        }
        return $cells;
    }
}

?>