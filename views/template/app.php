<?php
    /** @var string $view */
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Book Wise</title>
        
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    </head>
    <body class="bg-stone-950 text-stone-200 min-h-dvh flex flex-col items-start justify-center">
    
        <header class="bg-stone-900 w-full px-4 lg:px-0">
            <nav class="mx-auto max-w-screen-lg flex justify-between gap-4 py-4">
                
                <div class="flex-1 md:flex-none md:w-60 font-bold text-xl tracking-wide">
                    <a href="/">
                        Book Wise
                    </a>
                </div>
                
                <ul class="flex space-x-4 items-center font-bold">
                    <li><a href="/" class="text-lime-500 hover:underline">Explore</a></li>
                    <li><a href="/my-books" class="hover:underline">My Books</a></li>
                </ul>
                
                <ul class="md:w-60 flex items-center justify-end">
                    <?php if(auth()): ?>
    
                        <li class="flex items-center justify-end gap-2">
                            <span class="hidden lg:block">Hi, <?= auth()->name ?>!</span>
                            <a class="text-lime-600 font-bold hover:underline hover:text-lime-500" href="/logout">Logout</a>
                        </li>
                    
                    <?php else: ?>
                        
                        <li><a class="hover:underline" href="/login">Login</a></li>
                        
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
        
        <main class="max-w-screen-lg w-full mx-auto px-4 lg:px-0 flex-1 bg-stone-950 space-y-6 py-6">
            
            <?php if($message = flash()->get('message')): ?>
                <div class="gap-2 px-4 py-2 border-1 bg-lime-800 border-lime-700 text-lime-400 rounded-md text-sm font-bold">
                    <?= $message ?>
                </div>
            <?php endif; ?>
            
            <?php if($error = flash()->get('error')): ?>
                <div class="gap-2 px-4 py-2 border-1 bg-red-800 border-red-700 text-red-400 rounded-md text-sm font-bold">
                    <?= $error ?>
                </div>
            <?php endif; ?>
            
            <?php require "../views/{$view}.view.php"; ?>
        
        </main>
    
    </body>
</html>