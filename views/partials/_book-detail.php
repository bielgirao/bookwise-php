<?php
    /**
     * @var array<Book> $book
     */
?>

<div class="p-4 rounded border-stone-800 border-2 bg-stone-900 h-fit">
    <div class="flex flex-col gap-2 md:flex-row  md:gap-5">
        <div class="w-1/2 sm:w-1/3 md:max-w-40">
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
            <div class="text-sm">
                <?= $book->description ?>
            </div>
            <div class="text-sm">
                <b>Release Year:</b> <?= $book->release_year ?>
            </div>
            <div class="text-sm">
                <b>Number of pages:</b> <?= $book->number_of_pages ?>
            </div>
        </div>
    </div>
</div>