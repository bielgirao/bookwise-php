<?php
    
    if (!auth()) {
        abort(403);
    }
    
    $books = Book::getByUser(auth()->id);
    
    view("my-books", compact('books'));