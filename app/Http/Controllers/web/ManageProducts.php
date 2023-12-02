<?php

namespace App\Http\Controllers\web;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ImagesProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ManageProducts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'title' => 'Products List',
            'products' => Products::with(['category', 'images'])->get(),
        ];
        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'title' => 'Create Product',
            'categories' => Categories::select('id', 'name')->get(),
        ];
        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|min:3|max:255',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required|min:3',
            'discount' => 'nullable|numeric',
            'foto.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:800',
        ]);
        try {
            DB::beginTransaction();
            $product = Products::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'stock' => $request->stock,
                'price' => $request->price,
                'description' => $request->description,
                'discount' => $request->discount,
            ]);
            foreach ($request->file('foto') as $key => $value) {
                $file = $value;
                $name_file = time() . '-' . Str::random(15) . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/products', $name_file);
                ImagesProduct::create([
                    'url' => $name_file,
                    'product_id' => $product->id,
                ]);
            }
            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product has been created');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('products.index')->with('error', 'Product failed to create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
