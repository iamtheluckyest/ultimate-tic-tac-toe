<?php
    // for URL /board
    class BoardController {
         public function getAction($request, $gameBoard) {
            $view = new BoardView('board');
            $view->assign('gameBoard', $gameBoard);
        }
    
        public function postAction($request, $gameBoard) {
            $data = $request->parameters;
            $player = $data['player'];
            $largeCoord = $data['coord'][0];
            $smallCoord = $data['coord'][1];
            $gameBoard->getCells()[$largeCoord]->setCellState($smallCoord, $player);
            return $gameBoard;
        }
    }

?>