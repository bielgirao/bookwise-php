<?php
    
    require '../models/Book.php';
    require '../models/User.php';
    require '../models/Review.php';
    
    session_start();
    
    require '../services/Flash.php';
    require '../functions.php';
    require '../services/Database.php';
    require '../services/Validation.php';
    require '../routes.php';