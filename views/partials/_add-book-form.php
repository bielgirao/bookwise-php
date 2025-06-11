<form action="/add-book" class="p-4 space-y-3" method="POST" enctype="multipart/form-data">
    <?php if($errors = flash()->get('errors_books')): ?>
        
        <div class="px-4 py-2 border-1 bg-red-900 border-red-800 text-red-400 rounded-md text-sm font-bold">
            <ul class="flex flex-col gap-2">
                <?php foreach ($errors as $error): ?>
                    
                    <li><?= $error ?></li>
                
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <div class="flex flex-col gap-2">
        <input name="user_id" type="hidden" value="<?= auth()->id ?>" />
        <label for="title" class="text-stone-400">Title</label>
        <input
            type="text"
            name="title"
            id="title"
            class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
            placeholder="Add book title"
        >
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="author" class="text-stone-400">Author</label>
        <input
            type="text"
            name="author"
            id="author"
            class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
            placeholder="Add book author"
        >
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="description" class="text-stone-400">Description</label>
        <textarea
            name="description"
            id="description"
            rows="4"
            class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
            placeholder="Add book description"
        ></textarea>
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="release_year" class="text-stone-400">Release Year</label>
        <select
            name="release_year"
            id="release_year"
            class="empty:text-stone-600 border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500 appearance-none"
        >
            <?php foreach(range(date('Y'), 1700, -1) as $year): ?>
                <option value="<?=$year?>"><?=$year?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="number_of_pages" class="text-stone-400">Number of Pages</label>
        <input
            type="number"
            min="0"
            name="number_of_pages"
            id="number_of_pages"
            class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
        >
    </div>
    
    <div class="flex flex-col gap-2">
        <label for="image" class="text-stone-400">Image</label>
        <input
            type="file"
            name="image"
            id="image"
            accept="image/jpeg,image/png"
            required
            class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
        >
    </div>
    
    <button
        type="submit"
        class="mt-2 px-4 py-2 bg-stone-900 text-stone-400 rounded-md hover:bg-stone-700 cursor-pointer"
    >
        Add Book
    </button>
</form>