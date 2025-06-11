<?php
    
    $searchKeyword = $_REQUEST['search'] ?? '';
    $books = Book::all($searchKeyword);
    
    view("index", compact("books", 'searchKeyword'));