<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorieen;

class CategoryController extends Controller
{
    public function create()
    {
        return view('form'); // Create a blade view for the category creation form
    }

    public function store(Request $request)
    {
        $request->validate([
            'newCategory' => 'required|unique:categorieen,naam', // Assuming 'categories' is the table name for categories
        ]);

        $category = new Categorieen();
        $category->naam = $request->input('newCategory');
        $category->save();

        return redirect()->route('categories.create')->with('success', 'Category added successfully!');
    }
}

