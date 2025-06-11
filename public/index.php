<?php
    
    require __DIR__ . '/../models/Book.php';
    require __DIR__ . '/../models/User.php';
    require __DIR__ . '/../models/Review.php';
    
    session_start();
    
    require __DIR__ . '/../services/Flash.php';
    require __DIR__ . '/../functions.php';
    require __DIR__ . '/../services/Database.php';
    require __DIR__ . '/../services/Validation.php';
    require __DIR__ . '/../routes.php';