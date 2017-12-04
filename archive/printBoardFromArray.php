<?php
    include_once 'gameboard.php';
    
    function printBoard($arr, $id) {
        $count = 0;
        foreach ($arr as $key => $value) {
            // If we're at the most deeply nested value, print it out
            if (gettype($arr[$key]) !== "array") {
                $count++;
                $fullId = $id."c".$count;
                if($fullId[7] === "1") {
                    if($fullId[5] === "1") {
                        if($fullId[3] === "1") {
                            // New large row
                            print("<div class='row cell'>");
                        }
                        // New big col
                        print("<div class='col s4 center largeCell'><div class='border-help'>");
                    }
                    // New small row 
                    print("<div class='smallRow'>");
                }
                
                // Actual content 
                print("<input name='".substr($fullId, 0, 4)."' type='radio' id='".$fullId."'><label for='".$fullId."'></label>");
                
                // close small row
                if ($fullId[7] === "3") {
                    print("</div>");
                    // close big col
                    if ($fullId[5] === "3"){
                        print("</div></div>");
                        // close big row
                        if ($fullId[3] ==="3" ) {
                           print("</div>"); 
                        }
                    }
                    
                }
            }
            // If we're not at the most deeply nested value, go deeper.
            else {
                printBoard($arr[$key], $id.$key);
            }
        }
    };
    
    
?>
