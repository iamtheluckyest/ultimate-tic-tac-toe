<?php

    include 'models/LargeBoardModel.php';
    
    session_start();
    if (!isset($_SESSION['gameBoard'])) {
      $_SESSION["gameBoard"] = new LargeBoardModel();
    }
?>