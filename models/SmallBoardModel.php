<?php

include_once 'BoardModel.php';

class SmallBoardModel extends BoardModel {
    
    public function setCellState($coord, $player) {
        if ($this->cells[$coord] ==="" && ($player === 0 || $player === 1)) {
            $this->cells[$coord] = $player;
            // $this->togglePlayer();
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
}
?>