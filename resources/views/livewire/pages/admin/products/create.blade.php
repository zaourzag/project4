<?php
// filepath: c:\Users\zaour\source\web1a\project\project-4-test\socks2\resources\views\pages\admin\products\create.blade.php

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

// For handling image preview and validation
$image = null;
$imagePreview = null;

// Form submission handler
if (request()->isMethod('post')) {
    $validated = request()->validate([
        'naam' => 'required|string|max:255',
        'omschrijving' => 'required|string',
        'prijs' => 'required|numeric|min:0',
        'image' => 'required|image|max:2048',
    ]);
    
    // Save image
    $imagePath = request()->file('image')->store('products', 'public');
    
    // Create product
    $product = Product::create([
        'naam' => $validated['naam'],
        'omschrijving' => $validated['omschrijving'],
        'prijs' => $validated['prijs'],
        'afbeelding' => Storage::url($imagePath),
    ]);
    
    // Redirect with success message
    return redirect()->route('admin.products')->with('success', 'Product created successfully!');
}
?>

<x-layouts.admin title="Add New Product">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">Create New Product</h1>
        <a href="{{ route('admin.products') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md border border-gray-300 bg-white text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-zinc-800 dark:text-gray-200 dark:hover:bg-zinc-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Products
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-md bg-red-50 p-4 dark:bg-red-900/50">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">Validation Error</h3>
                    <div class="mt-2 text-sm text-red-700 dark:text-red-200">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Tailwind Card replacing flux:card -->
    <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm rounded-lg border border-gray-200 dark:border-gray-700">
        <!-- Card Header -->
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-zinc-900">
            <h2 class="text-lg font-medium">Product Information</h2>
        </div>
        
        <!-- Card Body -->
        <div class="p-6">
            <form action="{{ url()->current() }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Left column -->
                    <div class="space-y-6">
                        <div>
                            <label for="naam" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Product Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                id="naam" 
                                name="naam" 
                                type="text" 
                                value="{{ old('naam') }}" 
                                required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-zinc-900 dark:text-white"
                            >
                            @error('naam')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="prijs" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Price (€) <span class="text-red-500">*</span>
                            </label>
                            <input 
                                id="prijs" 
                                name="prijs" 
                                type="number" 
                                step="0.01" 
                                min="0" 
                                value="{{ old('prijs') }}" 
                                required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-zinc-900 dark:text-white"
                            >
                            @error('prijs')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Right column -->
                    <div class="space-y-6">
                        <div>
                            <label for="omschrijving" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="omschrijving" 
                                name="omschrijving" 
                                rows="4"
                                required
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-zinc-900 dark:text-white"
                            >{{ old('omschrijving') }}</textarea>
                            @error('omschrijving')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Product Image <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center space-x-4">
                                <div class="grow">
                                    <input 
                                        id="image" 
                                        name="image" 
                                        type="file" 
                                        accept="image/*" 
                                        required
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:text-gray-400 dark:file:bg-zinc-700 dark:file:text-zinc-100"
                                    />
                                </div>
                                <div 
                                    x-data="{ imagePreview: null }" 
                                    x-init="$el.querySelectorAll('input[type=file]').forEach(el => el.addEventListener('change', function() { 
                                        if (el.files.length > 0) {
                                            const reader = new FileReader();
                                            reader.onload = (e) => { imagePreview = e.target.result; };
                                            reader.readAsDataURL(el.files[0]);
                                        }
                                    }))"
                                    class="relative h-24 w-24 overflow-hidden rounded border border-gray-200 dark:border-gray-700"
                                >
                                    <div class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-gray-800" x-show="!imagePreview">
                                        <svg class="h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <img x-show="imagePreview" x-bind:src="imagePreview" class="h-full w-full object-cover" />
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end space-x-3">
                    <button 
                        type="reset" 
                        class="px-4 py-2 text-sm font-medium rounded-md border border-gray-300 bg-white text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-zinc-800 dark:text-gray-200 dark:hover:bg-zinc-700"
                    >
                        Clear Form
                    </button>
                    <button 
                        type="submit" 
                        class="px-4 py-2 text-sm font-medium rounded-md border border-transparent bg-blue-600 text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>