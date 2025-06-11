<?php
    
    global $database;
    if( $_SERVER["REQUEST_METHOD"] == "POST" ){
        
        $validation = Validation::validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'confirmed', 'unique:users'],
            'password' => ['required', 'min:8', 'max:30', 'strongPassword'],
        ], $_POST);
        
        if($validation->invalid('register')) {
            redirect('/login');
        }
        
        $database->query(
            query: "INSERT INTO users (name, email, password) values (:name, :email, :password)",
            params: [
                "name" => $_POST["name"],
                "email" => $_POST["email"],
                "password" => password_hash($_POST["password"], PASSWORD_DEFAULT)
            ]
        );
        
        flash()->push('message', 'Account created successfully!');
        redirect('/login');
    }
    
    redirect('/login');