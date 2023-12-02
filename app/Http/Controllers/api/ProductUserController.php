<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductUserController extends Controller
{
    //
    public function index()
    {
        //debug token return token

        if (Auth::guard('api')->check()) {
            $products = Products::with(['images', 'category'])->get();
            return response()->json([
                'success' => true,
                'data' => $products,
                'message' => 'List Semua Produk',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Unauthorized',
            ], 401);
        }
    }

    public function productById($id)
    {

        if (Auth::guard('api')->check()) {

            $product = Products::with(['images', 'category'])->where('id', $id)->first();
            return response()->json([
                'success' => true,
                'data' => $product,
                'message' => 'Produk di temukan',
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Unauthorized',
            ], 401);
        }
    }
    public function productByCategory($id)
    {
        if (Auth::guard('api')->check()) {

            $product = Products::with(['images', 'category'])->where('category_id', $id)->get();
            return response()->json([
                'success' => true,
                'data' => $product,
                'message' => 'List Produk By Kategori',
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Unauthorized',
            ], 401);
        }
    }
    public function categories()
    {
        if (Auth::guard('api')->check()) {
            $categories = Categories::select('id', 'name')->get();
            return response()->json([
                'success' => true,
                'data' => $categories,
                'message' => 'List Kategori',
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Unauthorized',
            ], 401);
        }
    }
}
