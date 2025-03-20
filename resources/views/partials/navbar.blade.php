<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <!-- Sidebar toggle button for mobile -->
    <div x-data="{ open: false }" class="lg:hidden relative">
        <flux:button 
            @click="open = !open" 
            class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200"
        >
            <flux:icon name="bars-2" class="w-5 h-5 mr-2" />
            Menu
        </flux:button>

        <!-- Sidebar overlay -->
        <div 
            x-show="open" 
            @click.away="open = false" 
            class="fixed inset-0 bg-black bg-opacity-50 z-40"
        ></div>

        <!-- Sidebar content -->
        <div 
            x-show="open" 
            class="fixed top-0 left-0 w-64 h-full bg-white dark:bg-zinc-800 shadow-lg z-50 p-4 space-y-4 transform transition-transform duration-300"
            :class="{ '-translate-x-full': !open, 'translate-x-0': open }"
        >
            <flux:button 
                @click="open = false" 
                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white"
            >
                <flux:icon name="x-mark" class="w-6 h-6" />
            </flux:button>

            <!-- Mobile Menu -->
            <flux:navlist>
                <flux:menu.item icon="home" href="/" >Home</flux:menu.item>
                <flux:menu.item icon="shopping-bag" href="/shop">Shop</flux:menu.item>
                <flux:menu.item icon="information-circle" href="/about">About Us</flux:menu.item>
            </flux:navlist>
        </div>
    </div>

    <!-- Desktop Navbar -->
    <flux:navbar class="hidden lg:flex">
        <flux:navbar.item icon="home" href="/" >Home</flux:navbar.item>
        <flux:navbar.item icon="shopping-bag" href="/shop">Shop</flux:navbar.item>
        <flux:navbar.item icon="information-circle" href="/about">About Us</flux:navbar.item>
    </flux:navbar>

    <flux:spacer />

    <!-- Navbar actions -->
    <flux:navbar class="mr-4">
        <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />
        <flux:dropdown x-data="{ open: false }" align="end">
            <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme" @click="open = !open">
                <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
                <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />
                <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
            </flux:button>

            <flux:menu x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg shadow-lg z-50">
                <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>
                <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>
                <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:navbar>

    <!-- Cart count -->
    @livewire('cart-count')
</flux:header>