<?php
    // for URL /board
    class BoardController {
        
        public function getAction($request, $gameBoard) {
            $view = new BoardView('board');
            $view->assign('gameBoard', $gameBoard);
        }
    
        public function postAction($request, $gameBoard) {
            $coord = $request->parameters['coord'];
            $player = $request->parameters['player'];
            
            $success = $gameBoard->setCellState($coord, $player);
            $_SESSION["gameBoard"] = $gameBoard;
                     
            if ($success) {
                // For sending back html code
                return printBoard($gameBoard, "");
                // For sending back just data
                // return json_encode($gameBoard->getWholeBoard());
            } else {
                return null;
            }
        }
    }

?>