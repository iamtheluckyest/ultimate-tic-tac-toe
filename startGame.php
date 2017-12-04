<?php

    include 'models/BoardModel.php';

    $_SESSION["gameBoard"] = new BoardModel(false);
    
?>