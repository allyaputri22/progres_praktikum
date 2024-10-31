<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //mengambil data dari database melalui model Product
       //fungsi all() sama seperti SELECT*FROM
       $data = Product::all();
       return view("master-data.product-master.index-product", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('master-data.product-master.create-product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi input data
        $validasi_data = $request -> validate([
        'product_name' => 'required|string|max:255',
        'unit' => 'required|string|max:50',
        'type' => 'required|string|max:50',
        'information' => 'nullable|string',
        'qty' => 'required|integer',
        'vendor' => 'required|string|max:255',
        ]);

        //proses simpan data dalam database
        Product::create($validasi_data);
        return redirect()->back()->with('success','Product created succesfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('master-data.product-master.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request -> validate([
        'product_name' => 'required|string|max:255',
        'unit' => 'required|string|max:50',
        'type' => 'required|string|max:50',
        'information' => 'nullable|string',
        'qty' => 'required|integer',
        'vendor' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product -> update([
            'product_name' => $request -> product_name,
            'unit' => $request -> unit,
            'type' => $request -> type,
            'information' => $request -> information,
            'qty' => $request -> qty,
            'vendor' => $request -> vendor,
        ]);

        return redirect() -> back() -> with("Succes", "Product update successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
