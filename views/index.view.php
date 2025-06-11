<?php
    
    /**
     * @var array<Book> $books
     * @var string $searchKeyword
     */
    
?>

<form class="w-full flex space-x-2">
    <?php if(strlen($searchKeyword) > 0): ?>
        <a
            href="/"
            class="px-4 py-2 border-1 border-stone-800 text-stone-400 rounded-md hover:bg-stone-800 cursor-pointer"
        >Clear</a>
    <?php endif; ?>
    <div class="w-full flex space-x-2 relative">
        <input
                type="text"
                name="search"
                value="<?= $searchKeyword ?>"
                class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none pl-10 pr-3 py-2 w-full"
                placeholder="Search..."
        >
        <button type="submit" class="absolute left-0 h-full w-10 top-1/2 text-sm flex items-center justify-center -translate-y-1/2 cursor-pointer">🔎</button>
    </div>
</form>

<section class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach($books as $book) {
        require '../views/partials/_book.php';
    }?>
</section>

