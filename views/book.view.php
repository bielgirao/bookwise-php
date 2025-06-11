<?php
    /**
     * @var Book $book
     * @var array<Review> $reviews
     */
?>


<h1 class="text-2xl font-bold">
    <?= $book->title; ?>
</h1>

<?php require_once 'partials/_book-detail.php'; ?>

<h2 class="text-xl font-bold">Book Reviews</h2>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <?php if(auth()): ?>
        <div class="border border-stone-800 rounded">
            <h3 class="text-lg font-bold border-b border-stone-800 p-4">
                Rate this book
            </h3>
    
            <form action="/add-review" class="p-4 space-y-3" method="POST">
                <?php if($errors = flash()->get('errors_reviews')): ?>
    
                    <div class="px-4 py-2 border-1 bg-red-900 border-red-800 text-red-400 rounded-md text-sm font-bold">
                        <ul class="flex flex-col gap-2">
                            <?php foreach ($errors as $error): ?>
    
                                <li><?= $error ?></li>
                            
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
    
                <div class="flex flex-col gap-2">
                    <label for="review" class="text-stone-400">Review</label>
                    <textarea
                        type="text"
                        name="review"
                        rows="4"
                        class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
                        placeholder="Add your review"
                    ></textarea>
                </div>
    
                <div class="flex flex-col gap-2">
                    <label for="rating" class="text-stone-400">Rating</label>
                    <select
                        name="rating"
                        class="empty:text-stone-600 border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500 appearance-none"
                    >
                        <option value="" disabled selected hidden>Select a rating</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <input name="book_id" type="hidden" value="<?= $book->id ?>" />
                </div>
    
                <button
                        type="submit"
                        class="px-4 py-2 bg-stone-900 text-stone-400 rounded-md hover:bg-stone-700 cursor-pointer"
                >
                    Add Review
                </button>
            </form>
        </div>
    <?php else: ?>
        <div class="border border-stone-800 rounded h-fit">
            <h3 class="text-lg font-bold border-b border-stone-800 p-4">
                Rate this book
            </h3>

            <div class="flex flex-col gap-3 p-4 text-center">
                <a
                        href="/login"
                        class="px-4 py-2 bg-stone-900 border-1 border-stone-800 text-stone-400 rounded-md hover:bg-stone-700 cursor-pointer"
                >
                    Sign In
                </a>
                <a
                        href="/login"
                        class="px-4 py-2 border-1 border-stone-800 text-stone-400 rounded-md hover:bg-stone-800 cursor-pointer"
                >
                    Create an account
                </a>
            </div>
        </div>
    <?php endif; ?>
    <div class="md:col-span-3 flex flex-col gap-4">
        <?php if (sizeof($reviews) == 0): ?>
            <h2 class="text-md font-medium">This book has no reviews yet. Be the first to add one!</h2>
        <?php endif; ?>
        <?php  foreach ($reviews as $review) : ?>
            <div class="border border-stone-800 rounded p-4 h-fit flex flex-col gap-1">
                <p class="italic text-lg leading-6 text-stone-300 font-medium">"<?= $review->review ?>"</p>
                <p class="flex items-center gap-2">
                    <span class="text-stone-300 font-medium">Rating: </span><span class="text-xs"><?= getRatingStars($review->rating) ?></span>
                </p>
                <p class="flex items-center gap-2">
                    <span class="text-stone-300 font-medium">By: </span><span><?= $review->user_name ?></span>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>