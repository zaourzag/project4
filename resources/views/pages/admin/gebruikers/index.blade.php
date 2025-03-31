<?php

use App\Models\Product;
use Illuminate\Support\Facades\DB;

// Handle search and filtering
$search = request()->input('search', ''); // Set default value to empty string
$sortField = request()->input('sort', 'naam');
$sortDirection = request()->input('direction', 'desc');

// Query building
$query = Product::query(); // Start with base query

// Apply search if provided
if (!empty($search)) {
    $query->where(function($q) use ($search) {
        $q->where('naam', 'like', "%{$search}%")
          ->orWhere('omschrijving', 'like', "%{$search}%");
    });
}

// Apply sorting
$query->orderBy($sortField, $sortDirection);

// Get paginated results with query string
$products = $query->paginate(10)->withQueryString();

// Handle bulk actions
if (request()->has('action') && request()->has('selected')) {
    $selected = request()->input('selected', []);
    $action = request()->input('action');
    
    if ($action === 'delete' && !empty($selected)) {
        Product::whereIn('id', $selected)->delete();
        return redirect()->route('admin.products')->with('success', count($selected) . ' products deleted successfully');
    }
}
?>

<x-layouts.admin title="Manage Products">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md border border-transparent bg-blue-600 text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add New Product
        </a>
    </div>
    
   <!-- filepath: c:\Users\zaour\source\web1a\project\project-4-test\socks2\resources\views\pages\admin\products\index.blade.php -->
@if (session('success'))
<div class="mb-4 rounded-md bg-green-50 p-4 dark:bg-green-900/50">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium text-green-800 dark:text-green-200">
                {{ session('success') }}
            </p>
        </div>
    </div>
</div>
@endif
    
    <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-900 flex flex-col space-y-3 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
            <h2 class="text-lg font-medium">All Products</h2>
            
            <div class="flex w-full items-center space-x-2 sm:w-auto">
                <form method="GET" class="flex flex-1 items-center space-x-2 sm:flex-initial">
                    <input 
                        type="search" 
                        name="search" 
                        placeholder="Search products..." 
                        value="{{ $search }}" 
                        class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-zinc-900 dark:text-white"
                    />
                    <button 
                        type="submit" 
                        class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-zinc-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-zinc-700"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </form>
            </div>
        </div>
        
        <form method="POST" id="bulk-action-form">
            @csrf
            <div class="-mx-4 -my-3 sm:-mx-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="w-12 px-6 py-3 text-left">
                                <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-900"
                                    onclick="document.querySelectorAll('input[name^=selected]').forEach(el => el.checked = this.checked)" />
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'naam', 'direction' => $sortField === 'naam' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center space-x-1 hover:text-gray-700 dark:hover:text-gray-300">
                                    <span>Name</span>
                                    @if ($sortField === 'naam')
                                        <span>
                                            @if ($sortDirection === 'asc')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </span>
                                    @endif
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'prijs', 'direction' => $sortField === 'prijs' && $sortDirection === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center space-x-1 hover:text-gray-700 dark:hover:text-gray-300">
                                    <span>Price</span>
                                    @if ($sortField === 'prijs')
                                        <span>
                                            @if ($sortDirection === 'asc')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </span>
                                    @endif
                                </a>
                            </th>
                          
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-900">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <input type="checkbox" name="selected[]" value="{{ $product->id }}" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-900" />
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <img src="{{ $product->afbeelding }}" alt="{{ $product->naam }}" class="h-12 w-12 rounded-md object-cover" />
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->naam }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($product->omschrijving, 50) }}</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                        €{{ number_format($product->prijs, 2) }}
                                    </span>

                                </td>
                            
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">Edit</a>
                                        <a 
                                            href="#"
                                            onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this product?')) window.location.href='{{ route('admin.products.delete', $product->id) }}'"
                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        >
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="mb-3 h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-lg font-medium">No products found</p>
                                        <p class="mt-1">Get started by creating a new product</p>
                                        <a 
                                            href="{{ route('admin.products.create') }}" 
                                            class="mt-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        >
                                            Add Product
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
        
        <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <select 
                    name="action" 
                    form="bulk-action-form" 
                    class="rounded-md border-gray-300 py-1 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-zinc-900 dark:text-white"
                >
                    <option value="">Bulk Action</option>
                    <option value="delete">Delete</option>
                </select>
                <button 
                    form="bulk-action-form" 
                    type="submit" 
                    class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-zinc-800 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-zinc-700"
                >
                    Apply
                </button>
            </div>
            
            <div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-layouts.admin>