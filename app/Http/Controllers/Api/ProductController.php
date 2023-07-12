<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * admin account credentials:
     *  'email' => 'admin@gmail.com',
     *  'password' => 'admin123'
     */
    
    public function create(Request $request){

        //admin access token in creating product
        //$accessToken = $request->bearerToken();

        //token for admin account
       // $allowedToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjg5MTY2OTMxLCJleHAiOjE2ODkxNzA1MzEsIm5iZiI6MTY4OTE2NjkzMSwianRpIjoielVrc2hiUUc0aFZlRWhteCIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.axwBFwWTIEJRS6e-QA3aAFNauJoPPYqfNWLsHKDSooY';

        // Check if the provided access token matches the allowed token
        //if ($accessToken === $allowedToken){
            //try {
                $validatedData = $request->validate([
                    'name' => 'required|string|unique:products',
                    'stock' => 'required|integer|min:1',
    
                ]);
        
                $product = Product::create([
                    'name' => $validatedData['name'],
                    'stock' => $validatedData['stock']
                ]);
        
                return response()->json([
                    'message' => 'Product successfully created.'
                ], 201);
                 /*} catch(ValidationException $error){
                    return response()->json([
                        'message' => 'Product ID already taken',
                      ], 400);*/
           // } return response()->json(['message' => 'Unauthorized user. Admin can only create products.'], 401);
                
                 
        }  

    }