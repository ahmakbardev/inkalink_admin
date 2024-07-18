<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contents.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('contents.categories.create');
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Kategori baru berhasil dibuat');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('contents.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui');
    }



    // Add this method
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
