  <?php
    // Creates array of 3 inside a parent to allow for $gameboard array with nested rows and cols
    function nestArray($child, $childName){
        for ($i = 1; $i <= 3; $i++) {
            $parent[$childName . $i] = $child;
        };  
        return $parent;
    }
    
    // each row holds columns, whose values start out empty.
    $row = nestArray("1", "c");
    // by holding three rows, each Col effectively holds a small TTT board
    $Col = nestArray($row, "r");
    // each Row holds 3 Cols with a small TTT board each
    $Row = nestArray($Col, "C");
    // whole board created by repeating three Rows
    $gameBoard = nestArray($Row, "R");
?>