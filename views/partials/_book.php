<?php
    /**
     * @var array<Book> $book
     */
?>

<div class="p-4 rounded border-stone-800 border-2 bg-stone-900">
    <div class="flex gap-3">
        <div class="w-1/3 max-w-40">
            <?php if(strlen($book->image) > 0): ?>
                <img src="<?=$book->image?>" alt="<?=$book->title?>">
            <?php else: ?>
                <img src="images/placeholder.jpg" alt="<?=$book->title?>">
            <?php endif; ?>
        </div>
        <div class="flex-1 flex flex-col justify-center gap-2">
            <a
                    href="/book?id=<?= $book->id ?>"
                    class="font-semibold hover:underline text-lg"
            >
                <?= $book->title ?>
            </a>
            <div class="text-sm italic"><?= $book->author ?></div>
            <div class="text-xs"><?= getRatingStars($book->avg_rating) ?>(<?= $book->total_reviews ?> Reviews)</div>
            <div class="md:hidden">
                <?= $book->description ?>
            </div>
        </div>
    </div>
    <div class="hidden md:block text-sm mt-2">
        <?= $book->description ?>
    </div>
</div>