<?php
    
    class Review
    {
        public int $id;
        public int $user_id;
        public int $book_id;
        public string $review;
        public int $rating;
        
        // Appending this property from users table
        public string $user_name;
        
        public static function getByBookId(int $id): array
        {
            $database = new Database(config('database'));
            return $database->query(
                query:"SELECT r.*, u.name AS user_name FROM reviews r JOIN users u ON u.id = r.user_id WHERE r.book_id = :id",
                class: Review::class,
                params: compact('id')
            )->fetchAll();
        }
    }