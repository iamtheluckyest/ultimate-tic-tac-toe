<?php
    
    function printBoard($board, $parentCellNumber, $inactive = "") {
        $p1Turn = "";
        if($board->getCurrentPlayer()) {
            $turnClass = "class='p1-turn'";
        }
        
        // If we are on a smallBoard, we want to print the inputs
        if( get_class($board) === "SmallBoardModel" ){
            foreach($board->getCells() as $key => $value){
                
                $disabled = "";
                $playerClass = "";
                
                // TODO: add something to recognize the player's turn and add class "p1-turn" to label if it is p1's turn
                if ($value === 0 || $value === 1){
                    // TODO: Need to add a player class if there is a value
                    // Problem: class already exists in $turnClass
                    // but if we manipulate $turnClass, it will stay manipulated next time through the loop
                    $labelClass = "class='p" . $value . "'";
                } else {
                    $labelClass = $turnClass;
                }
                if($inactive) {
                    $disabled = "disabled='disabled'";   
                }
                
                if ($key === 0 || $key === 3 || $key === 6) {
                    // New small row
                    print("<div class='smallRow'>");
                }
                // Input square
                $coord = $parentCellNumber . $key;
                print("<input name='gameboard' type='radio' id='" . $coord . "' " . $disabled . ">");
                print("<label for='" . $coord . "'" . $labelClass . "></label>");
                
                if ($key === 2 || $key === 5 || $key === 8) {
                    // Close small row
                    print("</div>");
                }
            }
        }
        
        // If we are not on a smallBoard, we want to print the main rows/cols with the small board inside
        else {
            foreach($board->getCells() as $key => $value) {
                
                $inactive = "";
                if ($value->hasWinner()){
                    $inactive = " hasWinner" . $value->getWinner();
                }
                else if(!$value->getActiveState()) {
                    $inactive = " inactive";    
                } 
                
                if ($key === 0 || $key === 3 || $key === 6) {
                    // New large row
                    print("<div class='row cell'>");
                }
                    // New large col
                    print("<div class='col s4 center largeCell'>");
                    print("<div class='border-help" . $inactive ."' id='cell" . $key . "'>");
                    
                    // New small board
                    printBoard($value, $key, $inactive);

                    // Close large col
                    print("</div>");
                    print("</div>");
                    
                if ($key === 2 || $key === 5 || $key === 8){
                    // Close large row
                    print("</div>");
                }
            }
        }
    };
    
    
?>