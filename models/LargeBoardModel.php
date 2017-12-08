<?php
include_once 'BoardModel.php';
include_once 'SmallBoardModel.php';


class LargeBoardModel extends BoardModel {
    private $active;
    
    public function __construct () {
        parent::__construct();
        $this->active = true;
    }
    
    // Returns an array that represents the whole board
    public function getWholeBoard() {
        $wholeBoard = array();
        foreach($this->getCells() as $key => $value) {
            $wholeBoard[$key] = $this->getCells()[$key]->getCells();
        }
        return $wholeBoard;
    }
    
    public function setCellState($coord, $player){
        // Rename for easy reference
        $currentLargeBoard = $this->cells[$coord[0]];
        // Set the new value of the cell. Fails if cell has already been set
        $cellStateSetSuccess = $currentLargeBoard->setCellState($coord[1], $player);
        // If cell is successfully set, check for win on small board
        if ($cellStateSetSuccess){
            $smallBoardWon = $currentLargeBoard->checkForWin($coord[1], $player);
            // If a small board has been won, check for win on large board
            if ($smallBoardWon) {
                // TODO:
                // Check for whole board win
                // If won, end game.
            } else {
                // Activates large cell whose coord matches the coord of the small cell just played
                activateCell($coord[1]);
                return true;
            }
        }
        else {
            return false;
        }
    }
    
    protected function generateCell() {
        return new SmallBoardModel();
    }

    // Activates cell at index $coord, deactivates the rest, unless cell at $coord has been won
    private function activateCell($coord) {
        $deactivate = true;
        // Check if cell to be activated is already won. If so, all remaining large cells are activated.
        if ($this->cells[$coord]->hasWinner()) {  
            // activate all that aren't won
            $deactivate = false;
        } else {
            // activate only the next cell
        }   
        
        $this->cells[$coord]->active = $deactivate;
        for($i = 0; $i < $this->sizeof(cells); $i++) {
            if ($i !== $coord ) {
                $this->active = !$deactivate;
            }
        }
        
    }
    
}


?>