<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class OrderController extends Controller
{


    public function order(Request $request)
    {
        
        // Validate the request body
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized user. Please register an account first.'], 401);
        }

        // Check if the product is available in sufficient quantity
        $product_id = Product::findOrFail($validatedData['product_id']);
        if ($product_id->stock < $validatedData['quantity']) {
            return response()->json(['message' => 'Failed to order this product due to unavailability of the stock'], 400);
        }

    
        // Create the order
       $order = new Order();
       $order->product_id = $validatedData['product_id'];
       $order->quantity = $validatedData['quantity'];
       $order->save();

       Product::where('id', $request->product_id)->decrement('stock', $request->quantity);

        return response()->json(['message' => 'You have successfully ordered this product.'], 201);
    }
}
