<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorieen;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'newCategory' => 'required|unique:categorieen,naam',
        ]);
    
        $category = new Categorieen();
        $category->naam = $request->input('newCategory');
        $category->save();
    
        return redirect()->route('products.create')->with([
            'success' => 'Category created successfully!',
            'input' => $request->input(),
        ]);
    }
}

