<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producten;
use App\Models\Categorieen;

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
        $categories = Categorieen::all();
        return view('form', compact('categories'));
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
            'naam' => $request->input('name'),
            'beschrijving' => $request->input('description'),
            'prijs' => $request->input('price'),
            'korting' => $request->input('discount'),
        ]);

        // Save the product to the database
        $product->save();

        $product->categorieen()->attach($request->input('categories'));

        // Add code to handle categories and tags assignment if needed

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // Show the form for editing the specified product
    public function edit($id)
    {
        $product = Producten::findOrFail($id);
        $categories = Categorieen::all();
        return view('form', compact('product', 'categories'));
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
        $product->naam = $request->input('name');
        $product->korting = $request->input('description');
        $product->prijs = $request->input('price');
        $product->korting = $request->input('discount');

        // Save the updated product to the database
        $product->save();

        $product->categorieen()->sync($request->input('categories'));

        // Add code to handle categories and tags assignment if needed

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Remove the specified product from the database
    public function destroy($id)
    {
        $product = Producten::findOrFail($id);

        // Detach categories before deleting
        $product->categorieen()->detach();

        $product->delete();

        // Add code to handle related categories and tags if needed

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}

