<!-- resources/views/components/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <title>Admin - {{ config('app.name') }}</title>
  
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('admin.dashboard') }}" class="mr-5 flex items-center space-x-2">
                <x-app-logo />
                <span class="text-xl font-bold">Admin</span>
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group heading="Dashboard" class="grid">
                    <flux:navlist.item icon="home" :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </flux:navlist.item>
                </flux:navlist.group>

                <flux:navlist.group heading="Products" class="grid">
                    <flux:navlist.item icon="shopping-bag" :href="route('admin.products')" :current="request()->routeIs('admin.products')">
                        All Products
                    </flux:navlist.item>
                    <flux:navlist.item icon="plus" :href="route('admin.products.create')" :current="request()->routeIs('admin.products.create')">
                        Add Product
                    </flux:navlist.item>
                </flux:navlist.group>

                <flux:navlist.group heading="Orders" class="grid">
                  
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <!-- User Menu -->
            <flux:dropdown position="top" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
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

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            Log Out
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
                <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
                <h1 class="text-xl font-bold">{{ $title ?? 'Admin Panel' }}</h1>
                <flux:spacer />
            </flux:header>

            <main class="flex-1 overflow-auto p-6">
                {{ $slot }}
                
            </main>
        </div>
        <!-- filepath: c:\Users\zaour\source\web1a\project\project-4-test\socks2\resources\views\components\layouts\admin.blade.php -->

<!-- Find and replace this: -->

<!-- With this: -->
@if(session('success'))
    <x-alert type="success" class="mb-4" />
@endif
    </div>

    @fluxScripts
   
@bukScripts
</body>
</html>