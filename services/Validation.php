<?php
    
    class Validation
    {
        public array $errors = [];
        
        /**
         * @param array<string, string[]> $rules
         * @param array<string, mixed>    $data
         * @return self
         */
        public static function validate(array $rules, array $data): Validation
        {
            $validation = new self;
            
            foreach($rules as $field => $fieldRules) {
                $value = $data[$field];
                
                foreach($fieldRules as $rule) {
                    if ($rule == 'confirmed') {
                        $confirmation = $data["{$field}_confirmation"];
                        $validation->$rule($field, $value, $confirmation);
                    } elseif (str_contains($rule, ':')) {
                        $temp = explode(':', $rule);
                        $rule = $temp[0];
                        $arg = $temp[1];
                        $validation->$rule($arg, $field, $value);
                    } else {
                        $validation->$rule($field, $value);
                    }
                }
            }
            
            return $validation;
        }
        
        private function required($field, $value): void{
            if(strlen($value) == 0) {
                $this->errors[] = "The $field is required.";
            }
        }
        
        private function email($field, $value): void {
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $this->errors[] = "The $field must be a valid email address.";
            }
        }
        
        private function confirmed($field, $value, $confirmation): void {
            if($value != $confirmation) {
                $this->errors[] = "The $field confirmation does not match.";
            }
        }
        
        private function min($min, $field, $value): void {
            if(strlen($value) <= $min) {
                $this->errors[] = "The $field must be at least $min characters.";
            }
        }
        
        private function max($max, $field, $value): void {
            if(strlen($value) >= $max) {
                $this->errors[] = "The $field cannot exceed $max characters.";
            }
        }
        
        private function minLength($min, $field, $value): void {
            if($value <= $min) {
                $this->errors[] = "The $field must be greater than $min.";
            }
        }
        
        private function maxLength($max, $field, $value): void {
            if($value >= $max) {
                $this->errors[] = "The $field cannot exceed $max.";
            }
        }
        
        private function strongPassword($field, $value): void {
            if(! strpbrk($value, '!@#$%^&*()+_-[\];.,/?|')) {
                $this->errors[] = "The $field must contain at least one special character.";
            }
        }
        
        private function unique($table, $field, $value): void {
            global $database;
            if(strlen($value) == 0) {
                return;
            }
            
            $result = $database->query(
                query: "SELECT * FROM $table WHERE $field = :value",
                params: ['value'  => $value]
            )->fetch();
            
            if($result) {
                $this->errors[] = "The $field already exists.";
            }
        }
        
        public function invalid($sessionKey = null): bool {
            $key = 'errors';
            
            if($sessionKey) {
                $key .= '_' . $sessionKey;
            }
            
            flash()->push($key, $this->errors);
            
            return sizeof($this->errors) > 0;
        }
    }