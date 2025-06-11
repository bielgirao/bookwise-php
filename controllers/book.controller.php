<?php
    
    $book = Book::get($_GET['id']);
    $reviews = Review::getByBookId($_GET['id']);
    
    view("book", compact("book", "reviews"));
