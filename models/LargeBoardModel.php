<?php
include_once 'BoardModel.php';
include_once 'SmallBoardModel.php';

class LargeBoardModel extends BoardModel {
    
    // Returns an array that represents the whole board, with active state
    public function getWholeBoard() {
        $wholeBoard = array();
        foreach($this->getCells() as $key => $value) {
            $wholeBoard[$key] = array(
                "content" => $value->getCells(), 
                "active" => $value->getActiveState(),
                "winner" => $value->getWinner(),
            );
        }
        $wholeBoard["gameInProgress"] = $this->active;
        $wholeBoard["player"] = $this->currentPlayer;
        $wholeBoard["totalWinner"] = $this->getWinner();
        return $wholeBoard;
    }
    
    // TODO? Set the $coord as a state so that I don't have to pass it around
    public function setCellState($coord){
        // Checks that game is still going
        if($this->getActiveState()){
            // Rename for easy reference
            $currentSmallBoard = $this->cells[$coord[0]];
            // Set the new value of the cell. Fails if cell has already been set
            $cellStateSetSuccess = $currentSmallBoard->setCellState($coord[1]);
            // If cell is successfully set, check for win on small board
            if ($cellStateSetSuccess){
                $smallBoardWinner = $currentSmallBoard->checkForWin($coord[1], $this->currentPlayer);
                // If a small board has been won, check for win on large board
                if ($smallBoardWinner === 0 || $smallBoardWon === 1) {
                    // Check for whole board win
                    // TODO: Some kind of error causes wins on the large board when they don't exist -> i.e. when opposite player wins due to full board
                    $largeBoardWon = $this->checkForWin($coord[0], $smallBoardWinner);
                    // If won, end game.
                    if($largeBoardWon) {
                        $this->setActiveState(false);
                        for($i = 0; $i < sizeof($this->cells); $i++) {
                            $this->cells[$i]->setActiveState(false);
                        }
                        return true;
                    } else {
                        // Activates large cell whose coord matches the coord of the small cell just played
                        $this->activateBoard($coord[1]);
                        return true;       
                    }
                } else {
                    // Activates large cell whose coord matches the coord of the small cell just played
                    $this->activateBoard($coord[1]);
                    return true;       
                }
            }
            // If something caused set cell to fail, i.e. cell has already been set
            else return false;
        } 
        // If game is over
        else return false;
    }
    
    public function togglePlayer() {
        if($this->currentPlayer === 0) {
            $this->currentPlayer = 1;
        } else {
            $this->currentPlayer = 0;
        }
        foreach($this->getCells() as $key => $value){
            $value->togglePlayer();
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