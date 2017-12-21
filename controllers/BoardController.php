<?php
    // for URL /board
    class BoardController {
        
        public function getAction($request, $gameBoard) {
            $view = new BoardView('board');
            $view->assign('gameBoard', $gameBoard);
        }
    
        public function postAction($request, $gameBoard) {
            $coord = $request->parameters['coord'];
            // $player = $request->parameters['player'];
            
            $success = $gameBoard->setCellState($coord);
                     
            if ($success) {
                $gameBoard->togglePlayer();
                $_SESSION["gameBoard"] = $gameBoard;
               
                // For sending back html code
                // printBoard($gameBoard);
                
                // For sending back just data
                return json_encode($gameBoard->getWholeBoard());
                
                // For sending back both would need to print_r("", true) everthing in printBoard, then concatonate and return
            } else {
                return null;
            }
        }
    }

?>