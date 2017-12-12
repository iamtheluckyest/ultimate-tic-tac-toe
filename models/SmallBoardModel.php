<?php

include_once 'BoardModel.php';

class SmallBoardModel extends BoardModel {
    
    public function setCellState($coord) {
        if ($this->cells[$coord] === "") {
            $this->cells[$coord] = $this->currentPlayer;
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
    
    public function togglePlayer() {
        if($this->currentPlayer === 0) {
            $this->currentPlayer = 1;
        } else {
            $this->currentPlayer = 0;
        }
    }
}
?>