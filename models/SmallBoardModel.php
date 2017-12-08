<?php

include_once 'BoardModel.php';

class SmallBoardModel extends BoardModel {
    
    public function setCellState($coord, $player) {
        if ($this->cells[$coord] ==="" && ($player === 0 || $player === 1)) {
            $this->cells[$coord] = $player;
            return true;
        }
        else {
            return false;
        }
    }
    
    protected function generateCell() {
        return "";
    }
    
    protected function checkforWin($coord, $player) {
        // if a 3-in-a-row row, col, or diagonal has been achieved, assign winner
        if ($this->winConditions[$player]->checkforWin($coord)){
            $this->assignWinner($player);
        }
        // if the board has no cells left , assign winner
        else if ( ($this->winConditions[0]->getTotal() + $this->winConditions[1]->getTotal()) === sizeof($this->cells) ) {
            $winner = 0;
            if ($this->winConditions[1]->getTotal() > $this->winConditions[0]->getTotal()) {
                $winner = 1;
            }
            $this->assignWinner($winner);
        }
    }
    
    protected function assignWinner($winner) {
        $this->boardWinner = $winner;
    }
    
    public function hasWinner() {
        if ($this->boardWinner === 0 || $this->boardWinner === 1){
            return true;
        } else {
            return false;
        }
    }
    
}


?>