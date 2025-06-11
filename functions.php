<?php
    
    // Using the "..." before the $dump declaration as a param we can receive a data list instead of just a single value
    use JetBrains\PhpStorm\NoReturn;
    
    #[NoReturn] function dd(...$dump): void
    {
        dump($dump);
        exit();
    }
    
    function dump(...$dump): void
    {
        echo "<pre>";
        var_dump($dump);
        echo "</pre>";
    }
    
    #[NoReturn] function abort($code): void
    {
        http_response_code($code);
        if ($code === 403) {
            view("403");
            die();
        }
        view("404");
        die();
    }
    
    function view($view, $data = []): void
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        require "views/template/app.php";
    }
    
    function flash(): Flash {
        return new Flash;
    }
    
    function config($key = null) {
        $config = require 'config.php';
        if(strlen($key) > 0) {
            return $config[$key];
        }
        return $config;
    }
    
    #[NoReturn] function redirect($url): void {
        header("Location: $url");
        exit();
    }
    
    function auth() {
        if(!isset($_SESSION['auth'])) {
            return null;
        }
        
        return $_SESSION['auth'];
    }
    
    function getRatingStars(int $rating): string {
        return str_repeat('⭐', $rating);
    }