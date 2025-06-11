<?php
    
    global $database;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $validation = Validation::validate([
            "email" => [
                'required',
                'email'
            ],
            "password" => ['required'],
        ], $_POST);
        
        if($validation->invalid('login')) {
            redirect('/login');
        }
        
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $user = $database->query(
            query: "SELECT * FROM users WHERE email = :email",
            class: User::class,
            params: compact("email")
        )->fetch();
        
        if ($user) {
            if (!password_verify($password, $user->password)) {
                flash()->push('errors_login', ["Invalid username or password"]);
                redirect('/login');
            }
            
            $_SESSION['auth'] = $user;
            flash()->push('message', "Welcome $user->name!");
            redirect('/');
        }
    }
    
    
    view("login");