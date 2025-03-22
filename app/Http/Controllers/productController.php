<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ProductAdded;

use App\Models\Product;

class productController  extends Controller
{
    // Get all products
    public function index(Request $request) 
    {
        $products = Product::all();
        return response()->json($products);
    }
    
    //
    public function addProduct(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required', // Ensure it's an image
        ]);
    
        // Handle the file upload
      
            $imageUrl = $request->image; // Handle cases where no image is uploaded
        
    
        // Save the product
        $product = new Product;
        $product->naam = $validated['name'];
        $product->omschrijving = $validated['description'];
        $product->prijs = $validated['price'];
        $product->afbeelding = $validated['image']; // Save the image URL
        $product->save();
        ProductAdded::dispatch($product);
        return response()->json(['message' => 'Product added successfully', 'product' => $request->all()]);
    }

}
