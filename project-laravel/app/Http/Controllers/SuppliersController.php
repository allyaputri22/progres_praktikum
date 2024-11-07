<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suppliers;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       //mengambil data dari database melalui model Product
       //fungsi all() sama seperti SELECT*FROM
       $data = Suppliers::all();
       return view("master-data.suppliers-master.index-suppliers", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('master-data.suppliers-master.create-suppliers');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi input data
        $validasi_data = $request -> validate([
        'supplier_name' => 'required|string|max:255',
        'supplier_address' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'comment' => 'nullable|string',
        ]);

        //proses simpan data dalam database
        Suppliers::create($validasi_data);
        return redirect()->back()->with('success','Suppliers add succesfully');

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
         $suppliers = Suppliers::findOrFail($id);
        return view('master-data.suppliers-master.edit-suppliers', compact('suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request -> validate([
        'supplier_name' => 'required|string|max:255',
        'supplier_address' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'comment' => 'nullable|string',
        ]);

        $suppliers = Suppliers::findOrFail($id);
        $suppliers -> update([
        'supplier_name' => $request-> supplier_name,
        'supplier_address' => $request-> supplier_address,
        'phone' => $request-> phone,
        'comment' => $request-> comment,
        ]);

        return redirect() -> back() -> with("Succes", "Suppliers update successfully!");
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suppliers = Suppliers::find($id);
        if ($suppliers) {
            $suppliers->delete();
            return redirect()->back()->with('succes', 'Supplier berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Supplier tidak ditemukan');
    }
}
