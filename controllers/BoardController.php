<?php
    // for URL/
    class BoardController {
         public function Action($gameBoard) {
            $view = new BoardView('board');
            $view->assign('gameBoard', $gameBoard);
        }
    
        public function postAction($request, $gameBoard) {
            $data = $request->parameters;
            $data['message'] = "This data was submitted";
            return $gameBoard;
        }
    }

?>