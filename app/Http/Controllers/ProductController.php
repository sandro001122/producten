<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producten;
use App\Models\Categorieen;
use App\Models\Tags;

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
        $tags = Tags::all();
        return view('form', compact('categories', 'tags'));
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'numeric',
        ]);

        // Handle image uploading
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'images/';
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($imagePath), $imageName);
        } else {
            $imageName = null;
        }

        $product = new Producten([
            'naam' => $request->input('name'),
            'beschrijving' => $request->input('description'),
            'prijs' => $request->input('price'),
            'korting' => $request->input('discount'),
            'images' => $imageName,
        ]);

        // Save the product to the database
        $product->save();

        $selectedTags = $request->input('tags', []);
        $inputTags = explode(',', $request->input('tags_input'));
        $tagIds = [];

        foreach ($inputTags as $tagName) {
            $tagName = trim($tagName);
            if (!empty($tagName)) {
                $tag = Tags::firstOrCreate(['naam' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }

        // Sync both selected tags and input tags with the product's tags
        $product->tags()->sync(array_merge($selectedTags, $tagIds));

        $product->categorieen()->attach($request->input('categories'));

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // Show the form for editing the specified product
    public function edit($id)
    {
        $product = Producten::findOrFail($id);
        $categories = Categorieen::all();
        $tags = Tags::all();
        return view('form', compact('product', 'categories', 'tags'));
    }

    // Update the specified product in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'numeric',
        ]);
        $product = Producten::findOrFail($id);

        // Handle image uploading
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = 'images/';
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($imagePath), $imageName);

            // Delete the old image if it exists
            if ($product->images) {
                $oldImagePath = public_path($imagePath . $product->images);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $product->images = $imageName;
        }

        
        $product->naam = $request->input('name');
        $product->korting = $request->input('description');
        $product->prijs = $request->input('price');
        $product->korting = $request->input('discount');

        // Save the updated product to the database
        $product->save();

        $selectedTags = $request->input('tags', []);
        $inputTags = explode(',', $request->input('tags_input'));
        $tagIds = [];

        foreach ($inputTags as $tagName) {
            $tagName = trim($tagName);
            if (!empty($tagName)) {
                $tag = Tag::firstOrCreate(['naam' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }

        // Sync both selected tags and input tags with the product's tags
        $product->tags()->sync(array_merge($selectedTags, $tagIds));

        $product->categorieen()->sync($request->input('categories'));

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // Remove the specified product from the database
    public function destroy($id)
    {
        $product = Producten::findOrFail($id);

        // Detach categories and tags before deleting
        $product->categorieen()->detach();
        $product->tags()->detach();

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}

