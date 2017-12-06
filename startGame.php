<?php

    include 'models/BoardModel.php';
    
    session_start();
    if (!isset($_SESSION['gameBoard'])) {
      $_SESSION["gameBoard"] = new BoardModel(false);
    }
    
    
?>