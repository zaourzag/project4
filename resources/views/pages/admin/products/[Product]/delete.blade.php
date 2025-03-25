<?php
// filepath: c:\Users\zaour\source\web1a\project\project-4-test\socks2\resources\views\pages\admin\products\[Product]\delete.blade.php

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

// Get product ID from the URL segment
try {
    // First try using the provided product parameter
    $product = Product::findOrFail($id);
} catch (\Exception $e) {
    // If product not found, redirect to the products page with an error
    return redirect()->route('admin.products')
        ->with('error', 'Product not found');
}
if ($productId === 'delete') {
    $productId = prev($segments);
}

// Find the product
$product = Product::findOrFail($productId);

// Handle form submission
if (request()->isMethod('post')) {
    // Delete image
    if ($product->afbeelding && Storage::exists('public/' . str_replace('/storage/', '', $product->afbeelding))) {
        Storage::delete('public/' . str_replace('/storage/', '', $product->afbeelding));
    }
    
    // Delete product
    $product->delete();
    
    // Redirect with success message
    return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
}
?>

<x-layouts.admin title="Delete Product">
    <div class="max-w-2xl mx-auto py-8">
        <div class="bg-white dark:bg-zinc-800 shadow-sm rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-red-600 dark:text-red-400 mb-4">Confirm Deletion</h2>
                <p class="mb-4">Are you sure you want to delete the product <strong>{{ $product->naam }}</strong>?</p>
                <p class="mb-6 text-gray-600 dark:text-gray-400">This action cannot be undone.</p>
                
                <div class="flex items-center gap-4">
                    <form method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Delete Product
                        </button>
                    </form>
                    
                    <a href="{{ route('admin.products') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>