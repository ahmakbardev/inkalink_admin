<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::all();
        return view('contents.results.index', compact('results'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('contents.results.create', compact('categories'));
    }

    public function edit($id)
    {
        $result = Result::findOrFail($id);
        $categories = Category::all();
        return view('contents.results.edit', compact('result', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_ids' => 'required|json',
            'code' => 'required|string|max:3|unique:results,code',
            'description' => 'required|string',
        ]);

        $categoryIds = json_decode($request->category_ids);
        if (count($categoryIds) !== 3) {
            return redirect()->back()->withErrors(['category_ids' => 'Anda harus memilih tepat 3 kategori.']);
        }

        Result::create([
            'category_ids' => $categoryIds, // Store as JSON
            'code' => $request->code,
            'description' => $request->description,
        ]);

        return redirect()->route('results.index')->with('success', 'Hasil kepribadian berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_ids' => 'required|json',
            'code' => 'required|string|size:3|unique:results,code,' . $id,
            'description' => 'required|string',
        ]);

        $categoryIds = json_decode($request->category_ids);
        if (count($categoryIds) !== 3) {
            return redirect()->back()->withErrors(['category_ids' => 'Anda harus memilih tepat 3 kategori.']);
        }

        $result = Result::findOrFail($id);
        $result->update([
            'category_ids' => $categoryIds, // Store as JSON
            'code' => $request->code,
            'description' => $request->description,
        ]);

        return redirect()->route('results.index')->with('success', 'Hasil kepribadian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $result = Result::findOrFail($id);
        $result->delete();

        return redirect()->route('results.index')->with('success', 'Hasil kepribadian berhasil dihapus.');
    }
}
