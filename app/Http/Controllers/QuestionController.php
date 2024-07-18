<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::select('category_id', DB::raw('MIN(id) as id'))
            ->groupBy('category_id')
            ->with('category')
            ->get();

        return view('contents.questions.index', compact('questions'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('contents.questions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'questions' => 'required|array|min:10|max:10',
            'questions.*' => 'required|string'
        ]);

        foreach ($request->questions as $questionText) {
            Question::create([
                'category_id' => $request->category_id,
                'question' => $questionText
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Pertanyaan kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $questions = Question::where('category_id', $question->category_id)->get();
        $categories = Category::all();

        return view('contents.questions.edit', compact('questions', 'categories', 'question'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'questions' => 'required|array|min:10|max:10',
            'questions.*' => 'required|string'
        ]);

        $category_id = $request->input('category_id');
        foreach ($request->input('questions') as $question_id => $question_text) {
            $question = Question::findOrFail($question_id);
            $question->update([
                'category_id' => $category_id,
                'question' => $question_text
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Pertanyaan kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Pertanyaan kategori berhasil dihapus.');
    }
}
