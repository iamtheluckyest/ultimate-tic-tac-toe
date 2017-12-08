<?php
    // for URL /board
    class BoardController {
        
        public function getAction($request, $gameBoard) {
            $view = new BoardView('board');
            $view->assign('gameBoard', $gameBoard);
        }
    
        public function postAction($request, $gameBoard) {
            $data = $request->parameters;
            
            $success = $gameBoard->setCellState($data['coord'], $data['player']);
            $_SESSION["gameBoard"] = $gameBoard;
                     
            if ($success) {
                return json_encode($gameBoard->getWholeBoard());
            } else {
                return null;
            }
        }
    }

?>