<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ReservationController extends Controller
{
    // Display the contents of the reservations
    public function index()
    {
        // Retrieve reserved products from the session
        $reservedItems = session()->get('reserved', []);
        return view('reserved.index', compact('reservedItems'));
    }

    // Reserve a product
    public function reserve(Request $request, $productId)
    {
        $product = Product::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        $product->reserved = true;
        $product->save();

        $reserved = session()->get('reserved', []);

        // Check if the product is already reserved and increase quantity
        if (isset($reserved[$productId])) {
            $reserved[$productId]['quantity'] += 1; // Increment quantity if already reserved
        } else {
            // Add a new product to the reservation if it's not already there
            $reserved[$productId] = [
                "name" => $product->name,
                "quantity" => 1,  // This is the initial reservation quantity
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        // Save the updated reservations back to the session
        session()->put('reserved', $reserved);

        return redirect()->back()->with('success', 'Product reserved!');
    }

    // Cancel a reservation
    public function cancel($id)
    {
        $reserved = session()->get('reserved', []);
        if (isset($reserved[$id])) {
            unset($reserved[$id]);
            session()->put('reserved', $reserved);
            return redirect()->route('reservations.index')->with('success', 'Reservation cancelled successfully.');
        }

        return redirect()->route('reservations.index')->with('error', 'Reservation not found.');
    }
}
