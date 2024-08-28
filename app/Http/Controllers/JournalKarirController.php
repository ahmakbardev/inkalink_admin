<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Illuminate\Http\Request;

class JournalKarirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data unik per user untuk ditampilkan dalam tabel
        $users = JournalEntry::with('user')->select('user_id')->distinct()->get();

        return view('contents.jurnalkarir.index', compact('users'));
    }

    public function show($userId)
    {
        $skills = JournalEntry::skills($userId)->get();
        $goals = JournalEntry::goals($userId)->get();
        $todos = JournalEntry::todos($userId)->get();

        return response()->json([
            'skills' => $skills,
            'goals' => $goals,
            'todos' => $todos,
        ]);
    }
}
