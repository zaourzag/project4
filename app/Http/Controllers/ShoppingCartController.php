<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    // Get all items in the cart
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        return response()->json($cart);
    }

    // Add an item to the cart
    public function add(Request $request)
    {
        $cart = $request->session()->get('cart', []);
    
        $productId = $request->input('id');
        $quantity = $request->input('quantity', 1);
    
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'image' => $request->input('image'),
                'quantity' => $quantity,
            ];
        }
    
        $request->session()->put('cart', $cart);
    
        return response()->json(['message' => 'Product added to cart', 'cart' => $cart]);
    }

    // Remove an item from the cart
    public function remove(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $productId = $request->input('id');
    
        if (isset($cart[$productId])) {
            // Decrease the quantity by 1
            $cart[$productId]['quantity'] -= 1;
    
            // If the quantity reaches 0, remove the product from the cart
            if ($cart[$productId]['quantity'] <= 0) {
                unset($cart[$productId]);
            }
    
            // Update the cart in the session
            $request->session()->put('cart', $cart);
        }
    
        return response()->json(['message' => 'Product quantity updated', 'cart' => $cart]);
    }

    // Clear the cart
    public function clear(Request $request)
    {
        $request->session()->forget('cart');
        return response()->json(['message' => 'Cart cleared']);
    }
}