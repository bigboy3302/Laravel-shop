<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductCreateRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        // Assuming authentication is required for managing products
        $this->middleware('auth');
    }

    public function showProducts()
{
    $products = Product::where('reserved', false)->paginate(3);
    return view('cards', compact('products'));
}

    public function create()
    {
        // View for creating a product
        return view('create_product');
    }

    // Utilizing a custom request to handle validation
    public function store(ProductCreateRequest $request)
    {
        $validated = $request->validated();
        $product = new Product($validated);

        // Improved image handling
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $product->image = $request->image->store('images', 'public');
        }

        $product->price = $request->input('price'); // Add this line to save the price

        $product->save();

        // Redirect to 'dashboard' with a success message
        return redirect()->route('dashboard')->with('success', 'Product created successfully!');
    }

    public function destroy($id)
    {
        // Deleting a product
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route('dashboard')->with('success', 'Product deleted successfully.');
        }
        return back()->with('error', 'Product not found.');
    }
}
