<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <!-- Sidebar toggle button for mobile -->
    <flux:brand href="#" logo="/images/Logo.svg" name="Acme Inc." class="max-lg:hidden flex dark:hidden" />
    <flux:brand href="#" logo="/images/logo2.svg" name="Acme Inc." class="max-lg:hidden! hidden dark:flex" />

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
        <flux:dropdown x-data align="end">
            <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">
                <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
                <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />
                <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
            </flux:button>
        
            <flux:menu>
                <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>
                <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>
                <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
        <flux:dropdown position="bottom" align="start">
            <flux:profile
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down"
            />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                >
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:navbar>

    <!-- Cart count -->
    @livewire('cart-count')
</flux:header>