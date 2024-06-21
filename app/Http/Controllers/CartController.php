<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Display the contents of the cart
    public function index()
    {
        // Retrieve the cart from session
        $cartItems = session()->get('cart', []);
        return view('cart.index', compact('cartItems')); // Ensure this view exists
    }

    // Add a product to the cart
    public function add(Request $request, $productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $cart = session()->get('cart', []);

        // Check if the product is already in the cart and increase quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            // Add a new product to the cart if it's not already in it
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        // Put the cart back into the session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Remove a product from the cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        // Check if the product is in the cart
        if (isset($cart[$id])) {
            unset($cart[$id]); // Remove the product from the cart
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}
