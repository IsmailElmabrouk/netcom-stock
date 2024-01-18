<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    // ...

    public function index()
    {
        try {
            $categories = Category::paginate(5); // Assuming you have a Category model
            return view('category.index', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->route('category.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('category.create');
        } catch (\Exception $e) {
            return redirect()->route('category.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            Category::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            return redirect()->route('category.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('category.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    // ...

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            return redirect()->route('category.index')->with('success', 'Catégorie mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('category.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $category = \App\Models\Category::findOrFail($id);
            return view('category.edit', compact('category'));
        } catch (\Exception $e) {
            return redirect()->route('category.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('category.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function CategoriesImport(Request $request)
    {
        try {
            $request->validate([
                'categoryFile' => 'required|mimes:csv,xlsx,xls',
            ]);

            Excel::import(new CategoriesImport, $request->file('categoryFile'));

            return redirect()->back()->with('success', 'Categories imported successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
