<?php
    // for URL /index
    class IndexController {
        
        public function getAction($request, $gameBoard) {
            $view = new IndexView('index');
            $view->assign('gameBoard', $gameBoard);
        }
    }
?>