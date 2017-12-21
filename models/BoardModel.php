<?php

include_once 'WinsModel.php';

class BoardModel {
    
    public $active;
    
    protected $winner;
    
    protected $winConditions;
    
    protected $cells;
    
    protected $currentPlayer;
    
    public function __construct () {
        $this->cells = $this->generateCells();
        $this->winConditions = array(new WinsModel, new WinsModel);
        $this->active = true;
        $this->currentPlayer = 0;
    }
    
    public function getCells() {
        return $this->cells;
    }
    
    public function getWinner() {
       return $this->winner; 
    }
    
    // template method
    public function togglePlayer() {
        throw new Exception("togglePlayer called in abstract base class");
    }
    
    public function getCurrentPlayer() {
        return $this->currentPlayer;
    }
    
    public function hasWinner() {
        if ($this->winner === 0 || $this->winner === 1){
            return true;
        } else {
            return false;
        }
    }
    
    public function getActiveState() {
        return $this->active;
    }
    
    // template method
    protected function generateCell() {
        throw new Exception("generateCell called in abstract base class");
    }
    
    // template method
    protected function setCellState() {
        throw new Exception("setCellState called in abstract base class");
    }
    
    protected function checkforWin($coord, $player) {
        // if a 3-in-a-row row, col, or diagonal has been achieved, assign winner
        if ($this->winConditions[$player]->checkforWin($coord, $player)) {
            return $this->assignWinner($player);
        }
        // if the board has no cells left, assign winner
        else if ( ($this->winConditions[0]->getTotal() + $this->winConditions[1]->getTotal()) === sizeof($this->cells) ) {
            $winner = 0;
            if ($this->winConditions[1]->getTotal() > $this->winConditions[0]->getTotal()) {
                $winner = 1;
            }
            return $this->assignWinner($winner);
        }
    }
    
    protected function setActiveState($newState) {
        $this->active = $newState;
    }
    
    protected function assignWinner($player) {
        $this->winner = $player;
        $this->active = false;
        return $player;
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