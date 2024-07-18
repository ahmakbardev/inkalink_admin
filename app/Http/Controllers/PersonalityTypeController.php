<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PersonalityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonalityTypeController extends Controller
{
    public function index()
    {
        $personalityTypes = PersonalityType::with('category')->get();
        return view('contents.tipe-kepribadian.index', compact('personalityTypes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('contents.tipe-kepribadian.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('public/personality_images');
        }

        PersonalityType::create($data);

        return redirect()->route('personality_types.index')->with('success', 'Tipe Kepribadian berhasil ditambahkan.');
    }

    public function show($id)
    {
        $personalityType = PersonalityType::with('category')->findOrFail($id);
        return view('contents.tipe-kepribadian.show', compact('personalityType'));
    }

    public function edit($id)
    {
        $personalityType = PersonalityType::findOrFail($id);
        $categories = Category::all();
        return view('contents.tipe-kepribadian.edit', compact('personalityType', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $personalityType = PersonalityType::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($personalityType->image) {
                Storage::delete($personalityType->image);
            }
            $data['image'] = $request->file('image')->store('public/personality_images');
        }

        $personalityType->update($data);

        return redirect()->route('personality_types.index')->with('success', 'Tipe Kepribadian berhasil diupdate.');
    }

    public function destroy($id)
    {
        $personalityType = PersonalityType::findOrFail($id);
        $personalityType->delete();

        return redirect()->route('personality_types.index')->with('success', 'Tipe Kepribadian berhasil dihapus.');
    }
}
