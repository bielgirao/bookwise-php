<?php
    
    class Flash
    {
        public function push($key, $value): void {
            $_SESSION["flash_{$key}"] = $value;
        }
        
        public function get($key) {
            if(!isset($_SESSION["flash_{$key}"])) {
                return false;
            }
            $response = $_SESSION["flash_{$key}"];
            unset($_SESSION["flash_{$key}"]);
            return $response;
        }
    }