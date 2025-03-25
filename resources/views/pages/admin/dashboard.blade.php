<?php
// filepath: c:\Users\zaour\source\web1a\project\project-4-test\socks2\resources\views\pages\admin\dashboard.blade.php

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

// Get statistics
$stats = [
    'products' => Product::count(),
    'users' => User::count(),
    'latest_products' => Product::get()->take(5),
    // You can add more stats as needed
];

// Get some activity data (you might need to adjust this based on your models)
$recent_activity = Product::get()->take(5);

// Convert to format usable by charts
$chart_data = [
    'labels' => $recent_activity->pluck('date')->map(function($date) {
        return \Carbon\Carbon::parse($date)->format('M d');
    })->toArray(),
    'data' => $recent_activity->pluck('count')->toArray(),
];
?>

<x-layouts.admin title="Dashboard">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Here's what's happening with your store today.</p>
    </div>
    
    <!-- Stats Cards -->
    <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Products Stats -->
        <div class="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-zinc-900">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-md bg-blue-100 p-3 dark:bg-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Total Products</dt>
                            <dd>
                                <div class="text-xl font-bold text-gray-900 dark:text-white">{{ $stats['products'] }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 dark:bg-zinc-800">
                <div class="text-sm">
                    <a href="{{ route('admin.products') }}" class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400">View all products</a>
                </div>
            </div>
        </div>

        <!-- Users Stats -->
        <div class="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-zinc-900">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-md bg-green-100 p-3 dark:bg-green-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Total Users</dt>
                            <dd>
                                <div class="text-xl font-bold text-gray-900 dark:text-white">{{ $stats['users'] }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 dark:bg-zinc-800">
                <div class="text-sm">
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400">View all users</a>
                </div>
            </div>
        </div>

        <!-- Add more stat cards as needed -->
        <!-- Revenue Stats -->
        <div class="overflow-hidden rounded-lg bg-white shadow-sm dark:bg-zinc-900">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 rounded-md bg-purple-100 p-3 dark:bg-purple-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="truncate text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</dt>
                            <dd>
                                <div class="text-xl font-bold text-gray-900 dark:text-white">€{{ number_format(1234.56, 2) }}</div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 dark:bg-zinc-800">
                <div class="text-sm">
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400">View finance reports</a>
                </div>
            </div>
        </div>

        <!-- Orders Stats -->
        
    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <h2 class="mb-4 text-xl font-bold">Quick Actions</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.products.create') }}" class="flex items-center rounded-lg border border-gray-200 bg-white p-4 shadow-sm transition hover:bg-gray-50 dark:border-gray-700 dark:bg-zinc-900 dark:hover:bg-zinc-800">
                <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium">Add Product</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Create a new product listing</p>
                </div>
            </a>
            
            <a href="#" class="flex items-center rounded-lg border border-gray-200 bg-white p-4 shadow-sm transition hover:bg-gray-50 dark:border-gray-700 dark:bg-zinc-900 dark:hover:bg-zinc-800">
                <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium">View Orders</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Manage customer orders</p>
                </div>
            </a>
            
            <a href="#" class="flex items-center rounded-lg border border-gray-200 bg-white p-4 shadow-sm transition hover:bg-gray-50 dark:border-gray-700 dark:bg-zinc-900 dark:hover:bg-zinc-800">
                <div class="mr-3 flex h-10 w-10 items-center justify-center rounded-full bg-purple-100 dark:bg-purple-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium">Analytics</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">View store statistics</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Products Section -->
    <div class="mb-8">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-xl font-bold">Recent Products</h2>
            <a href="{{ route('admin.products') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400">View all</a>
        </div>
        
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-zinc-900">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-zinc-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Product
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                            Added
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($stats['latest_products'] as $product)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded-lg object-cover" src="{{ $product->afbeelding }}" alt="{{ $product->naam }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $product->naam }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">€{{ number_format($product->prijs, 2) }}</div>
                            </td>
                          
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    
                    @if($stats['latest_products']->isEmpty())
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No products found. <a href="{{ route('admin.products.create') }}" class="text-blue-600 hover:text-blue-500 dark:text-blue-400">Add a product</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="mb-8">
        <h2 class="mb-4 text-xl font-bold">Activity Overview</h2>
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-zinc-900">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-medium">Products Added</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Last 30 days</p>
                </div>
            </div>
            
            <!-- Chart Container -->
            <div class="h-64">
                <canvas id="activityChart"></canvas>
            </div>
        </div>
    </div>
</x-layouts.admin>

