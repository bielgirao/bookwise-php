<?php
    
    class Book {
        public int $id;
        public int $user_id;
        public string $title;
        public string $author;
        public string $description;
        public int $release_year;
        public int $number_of_pages;
        public string $image;
        public int $total_reviews;
        public int $avg_rating;
        
        public function query($where, $params): PDOStatement
        {
            $database = new Database(config('database'));
            
            return $database->query(
                query: "
                SELECT
                  b.id,
                  b.title,
                  b.author,
                  b.description,
                  b.release_year,
                  b.number_of_pages,
                  COALESCE(b.image, '') as image,
                  COALESCE(COUNT(r.id), 0) AS total_reviews,
                  COALESCE(FLOOR(AVG(r.rating)), 0) AS avg_rating
                FROM books AS b
                LEFT JOIN reviews AS r
                  ON r.book_id = b.id
                WHERE $where
                GROUP BY
                  b.id, b.title, b.author, b.description, b.release_year, b.number_of_pages, b.image;
                ",
                class: self::class, params: $params
            );
        }
        
        public static function all($keyword = ''): array
        {
            return (new self)
                ->query('
                    b.title LIKE :keyword OR b.author LIKE :keyword
                    OR b.description LIKE :keyword',
                    ['keyword' => "%$keyword%"])
                ->fetchAll();
        }
        
        public static function get(int $id): ?Book
        {
            return (new self)->query('b.id = :id', compact('id'))->fetch();
        }
        
        public static function getByUser(int $user_id): array
        {
            return (new self)->query('b.user_id = :user_id', compact('user_id'))->fetchAll();
        }
    }