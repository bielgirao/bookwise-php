<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="border border-stone-800 rounded h-fit">
        <h1 class="text-lg font-bold border-b border-stone-800 p-4">
            Sign In
        </h1>
        
        <form action="/login" class="p-4 space-y-3" method="POST">
            <?php if($errors = flash()->get('errors_login')): ?>

                <div class="px-4 py-2 border-1 bg-red-900 border-red-800 text-red-400 rounded-md text-sm font-bold">
                    <ul class="flex flex-col gap-2">
                        <?php foreach ($errors as $error): ?>

                            <li><?= $error ?></li>
                        
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <div class="flex flex-col gap-2">
                <label for="email" class="text-stone-400">Email</label>
                <input
                        type="email"
                        name="email"
                        id="email"
                        required
                        class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
                        placeholder="email@mail.com"
                >
            </div>

            <div class="flex flex-col gap-2">
                <label for="password" class="text-stone-400">Password</label>
                <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
                        placeholder="email@mail.com"
                >
            </div>

            <button
                type="submit"
                class="px-4 py-2 bg-stone-900 text-stone-400 rounded-md hover:bg-stone-700 cursor-pointer"
            >
                Login
            </button>
        </form>
    </div>

    <div class="border border-stone-800 rounded">
        <h1 class="text-lg font-bold border-b border-stone-800 p-4">
            New here? Sign Up
        </h1>

        <form action="/register" method="POST" class="p-4 space-y-3">
            <?php if($errors = flash()->get('errors_register')): ?>
                
                <div class="px-4 py-2 border-1 bg-red-900 border-red-800 text-red-400 rounded-md text-sm font-bold">
                    <ul class="flex flex-col gap-2">
                        <?php foreach ($errors as $error): ?>

                            <li><?= $error ?></li>
                            
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <div class="flex flex-col gap-2">
                <label for="name" class="text-stone-400">Name</label>
                <input
                        type="text"
                        name="name"
                        id="name"
                        required
                        class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
                        placeholder="John Doe"
                >
            </div>
            
            <div class="flex flex-col gap-2">
                <label for="email" class="text-stone-400">Email</label>
                <input
                        type="email"
                        name="email"
                        id="email"
                        required
                        class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
                        placeholder="email@mail.com"
                >
            </div>

            <div class="flex flex-col gap-2">
                <label for="email-confirmation" class="text-stone-400">Confirm Email</label>
                <input
                        type="email"
                        name="email_confirmation"
                        id="email-confirmation"
                        required
                        class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
                        placeholder="email@mail.com"
                >
            </div>

            <div class="flex flex-col gap-2">
                <label for="password" class="text-stone-400">Password</label>
                <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-3 py-2 w-full placeholder-stone-500"
                >
            </div>
            
            <div class="flex justify-between items-center">
                <button
                        type="submit"
                        class="px-4 py-2 bg-stone-900 text-stone-400 rounded-md hover:bg-stone-700 cursor-pointer"
                >
                    Register
                </button>

                <button
                        type="reset"
                        class="px-4 py-2 border-1 border-stone-700 text-stone-400 rounded-md hover:bg-stone-800 cursor-pointer"
                >
                    Cancel
                </button>
            </div>
        </form>
    </div>

</div>