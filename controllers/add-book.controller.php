<?php
    
    require_once __DIR__ . '/../services/ImageCropper.php';
    global $database;
    
    if(!$_SERVER["REQUEST_METHOD"] == "POST") {
        redirect("/my-books");
    }
    
    if(!auth()) {
        abort(403);
    }
    
    $user_id = auth()->id;
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $release_year = $_POST['release_year'];
    $number_of_pages = $_POST['number_of_pages'];
    
    $currentYear = date("Y");
    $maxYearValidation = 'maxLength:' . $currentYear;
    
    $validation = Validation::validate([
        'title' => ['required', 'min:3', 'max:255'],
        'author' => ['required', 'min:3', 'max:100'],
        'description' => ['required', 'min:3'],
        'release_year' => ['required', 'minLength:1700', $maxYearValidation],
        'number_of_pages' => ['required', 'minLength:1'],
    ], $_POST);
    
    if($validation->invalid('books')) {
        redirect('/my-books');
    }
    
//    $randomName = md5(rand());
//    $extension = pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION);
//    $image = "images/$randomName.$extension";
//    move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../public/'.$image);
    
    try {
        $imageAbsolute = ImageCropper::cropAndSave(
            $_FILES['image'],
            568,
            872,
            __DIR__ . '/../public/images'
        );
    } catch (Exception $e) {
        flash()->push('error', $e->getMessage());
        redirect('/my-books');
    }
    
    $publicRoot = realpath(__DIR__ . '/../public') . '/';
    $image = str_replace($publicRoot, '', $imageAbsolute);
    
    $database->query(
        query: "
            INSERT INTO books (user_id, title, author, description, release_year, number_of_pages, image)
            values (:user_id, :title, :author, :description, :release_year, :number_of_pages, :image)
        ",
        class: Book::class,
        params: compact('user_id', 'title', 'author', 'description', 'release_year', 'number_of_pages', "image")
    );
    
    flash()->push('message', 'Book added successfully!');
    redirect('/my-books');