<?php
    /**
     * @var array<Book> $books
     */
?>

<h1 class="text-2xl font-bold">
    My books
</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="md:col-span-3 gap-4 grid grid-cols-1 lg:grid-cols-2 h-fit">
        <?php if (sizeof($books) == 0): ?>
            <h2 class="text-md font-medium">Looks like you haven't added any books yet.</h2>
        <?php endif; ?>
        
        <?php foreach($books as $book) {
            require __DIR__ . '/../views/partials/_book.php';
        }?>
    
    </div>
    <div class="w-full border border-stone-800 rounded">
        <h3 class="text-lg font-bold border-b border-stone-800 p-4">
            Add a new Book
        </h3>

        <?php require_once __DIR__ . '/../views/partials/_add-book-form.php'; ?>
    </div>
</div>