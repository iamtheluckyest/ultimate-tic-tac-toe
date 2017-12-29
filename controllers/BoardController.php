<?php
    // for URL /board
    class BoardController {
        
        public function getAction($request, $gameBoard) {
            return json_encode($gameBoard->getWholeBoard());
        }
    
        public function postAction($request, $gameBoard) {
            $coord = $request->parameters['coord'];

            $success = $gameBoard->setCellState($coord);
                     
            if ($success) {
                $gameBoard->togglePlayer();
                $_SESSION["gameBoard"] = $gameBoard;
                
                return json_encode($gameBoard->getWholeBoard());
                
            } else {
                return null;
            }
        }
    }

?>