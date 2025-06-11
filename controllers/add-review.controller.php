<?php
    
    global $database;
    if($_SERVER['REQUEST_METHOD'] != 'POST') {
        redirect('/');
    }
    
    $validation = Validation::validate([
      'review' => ['required'],
      'rating' => ['required'],
    ],$_POST);
    
    $user_id = auth()->id;
    $book_id = $_POST['book_id'];
    
    if($validation->invalid('reviews')) {
        redirect('/book?id=' . $book_id);
    }
    
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    
    $database->query(
        query: "
            INSERT INTO reviews (user_id, book_id, review, rating)
            values (:user_id, :book_id, :review, :rating)
            ",
        params: compact('user_id', 'book_id', 'review', 'rating'));
    
    flash()->push('message', 'Your review has been submitted.');
    redirect('/book?id=' . $book_id);
    
    