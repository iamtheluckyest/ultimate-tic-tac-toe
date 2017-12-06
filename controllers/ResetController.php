<?php
    // for URL /board
    class ResetController {
        
        public function putAction($request, $gameBoard) {
           unset($_SESSION["gameBoard"]);
           print_r("Game restarted");
        }
    }

?>