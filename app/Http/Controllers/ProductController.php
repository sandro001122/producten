<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producten;

class ProductController extends Controller
{
    // Display a list of products
    public function index()
    {
        $products = Producten::all();
        return view('products', compact('products'));
    }

    // Show the form for creating a new product
    public function create()
    {
        return view('products.form');
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'numeric',
            // Add validation rules for categories and tags if needed
        ]);

        $product = new Producten([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
        ]);

        // Save the product to the database
        $product->save();

        // Add code to handle categories and tags assignment if needed

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // Show the form for editing the specified product
    public function edit($id)
    {
        $product = Producten::findOrFail($id);
        return view('products.form', compact('product'));
    }

    // Update the specified product in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'numeric',
            // Add validation rules for categories and tags if needed
        ]);

        $product = Producten::findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->discount = $request->input('discount');

        // Save the updated product to the database
        $product->save();

        // Add code to handle categories and tags assignment if needed

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Remove the specified product from the database
    public function destroy($id)
    {
        $product = Producten::findOrFail($id);
        $product->delete();

        // Add code to handle related categories and tags if needed

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}

