<?php
    
    function printBoard($board, $parentCellNumber) {
        
        // print_r($board);
        
        // If we are on a smallBoard, we want to print the inputs
        if( get_class($board) === "SmallBoardModel" ){
            foreach($board->getCells() as $key => $value){
                
                if ($key===0 || $key===3 || $key===6) {
                    // New small row
                    print("<div class='smallRow'>");
                }
                // Input square
                $coord = $parentCellNumber . $key;
                print("<input name='".$parentCellNumber."' type='radio' id='".$coord."'><label for='".$coord."'". ( $value !=="" ? "class='p".$value."'" : "") . "></label>");
                if ($key===2 || $key===5 || $key===8) {
                    // Close small row
                    print("</div>");
                }
            }
        }
        
        // If we are not on a smallBoard, we want to print the main rows/cols with the small board inside
        else {
            foreach($board->getCells() as $key => $value){
                if ($key===0 || $key===3 || $key===6) {
                    // New large row
                    print("<div class='row cell'>");
                }
                    // New large col
                    print("<div class='col s4 center largeCell'>");
                    print("<div class='border-help'>");
                    
                    // New small board
                    printBoard($board->getCells()[$key], $key);

                    // Close large col
                    print("</div>");
                    print("</div>");
                    
                if ($key===2 || $key===5 || $key===8){
                    // Close large row
                    print("</div>");
                }
                
            }
        }
    };
    
    
?>