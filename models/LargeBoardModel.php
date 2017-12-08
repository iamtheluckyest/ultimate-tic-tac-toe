<?php
include_once 'BoardModel.php';
include_once 'SmallBoardModel.php';

// TODO:
// Surely I can clean up this mess of methods... I suspect many could be combined

class LargeBoardModel extends BoardModel {
    
    // Returns an array that represents the whole board, with active state
    public function getWholeBoard() {
        $wholeBoard = array();
        foreach($this->getCells() as $key => $value) {
            $wholeBoard[$key] = array(
                "content" => $this->getCells()[$key]->getCells(), 
                "active" => $this->getCells()[$key]->getActiveState(),
                "winner" => $this->getCells()[$key]->getWinner()
            );
        }
        return $wholeBoard;
    }
    
    public function setCellState($coord, $player){
        // Rename for easy reference
        $currentSmallBoard = $this->cells[$coord[0]];
        // Set the new value of the cell. Fails if cell has already been set
        $cellStateSetSuccess = $currentSmallBoard->setCellState($coord[1], $player);
        // If cell is successfully set, check for win on small board
        if ($cellStateSetSuccess){
            $smallBoardWon = $currentSmallBoard->checkForWin($coord[1], $player);
            // If a small board has been won, check for win on large board
            if ($smallBoardWon) {
                // TODO:
                // Check for whole board win
                // If won, end game.
            } else {
                // Activates large cell whose coord matches the coord of the small cell just played
                $this->activateBoard($coord[1]);
                return true;
            }
        }
        else {
            return false;
        }
    }
    
    // Sets cell content to object of smallBoardModel class when model is created.
    protected function generateCell() {
        return new SmallBoardModel();
    }

    // Activates cell at index $coord, deactivates the rest, unless cell at $coord has been won
    private function activateBoard($coord) {
        $deactivate = true;
        // Check if cell to be activated is already won. If so, all remaining large cells are activated.
        if ($this->cells[$coord]->hasWinner()) {  
            // activate all that aren't won
            $deactivate = false;
        }  
        
        // Loop through smallBoards and activate or deactivate as appropriate
        $this->cells[$coord]->setActiveState($deactivate);
        for($i = 0; $i < sizeof($this->cells); $i++) {
            // Don't update cells with winners. Keep them deactivated.
            if ($i !== (int)$coord && !$this->cells[$i]->hasWinner()) {
                $this->cells[$i]->setActiveState(!$deactivate);
            }
        }
    }
    
}


?>