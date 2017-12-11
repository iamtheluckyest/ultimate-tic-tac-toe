<?php
    
    function printBoard($board, $parentCellNumber, $inactive = "") {
        
        // If we are on a smallBoard, we want to print the inputs
        if( get_class($board) === "SmallBoardModel" ){
            foreach($board->getCells() as $key => $value){
                
                $disabled = "";
                $playerClass = "";
                if ($value === 0 || $value === 1){
                    $playerClass = "class='p" . $value . "'";
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
                print("<label for='" . $coord . "'" . $playerClass . "></label>");
                
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
                if(!$value->getActiveState()) {
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