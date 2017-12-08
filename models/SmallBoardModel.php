<?php

include_once 'BoardModel.php';

// TODO:
// Surely I can clean up this mess of methods... I suspect many could be combined

class SmallBoardModel extends BoardModel {
    private $active;
    
    public function __construct () {
        parent::__construct();
        $this->active = true;
    }
    
    public function setCellState($coord, $player) {
        if ($this->cells[$coord] ==="" && ($player === 0 || $player === 1)) {
            $this->cells[$coord] = $player;
            return true;
        }
        else {
            return false;
        }
    }
    
    // Sets cell content to "" when model is created.
    protected function generateCell() {
        return "";
    }
    
    public function getWinner() {
       return $this->winner; 
    }
    
    public function getActiveState() {
        return $this->active;
    }
    
    public function setActiveState($newState) {
        $this->active = $newState;
    }
    
    public function checkforWin($coord, $player) {
        // if a 3-in-a-row row, col, or diagonal has been achieved, assign winner
        if ($this->winConditions[$player]->checkforWin($coord, $player)){
            gettype($player);
            $this->assignWinner($player);
        }
        // if the board has no cells left, assign winner
        else if ( ($this->winConditions[0]->getTotal() + $this->winConditions[1]->getTotal()) === sizeof($this->cells) ) {
            $winner = 0;
            if ($this->winConditions[1]->getTotal() > $this->winConditions[0]->getTotal()) {
                $winner = 1;
            }
            $this->assignWinner($winner);
        }
    }
    
    public function hasWinner() {
        if ($this->winner === 0 || $this->winner === 1){
            return true;
        } else {
            return false;
        }
    }
    
    private function assignWinner($winner) {
        $this->winner = $winner;
        $this->active = false;
    }
    
}


?>