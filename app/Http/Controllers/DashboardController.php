<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch data from the database
        $eligibilityData = DB::table('eligibility_results')
            ->join('users', 'eligibility_results.user_id', '=', 'users.id')
            ->select('eligibility_results.*', 'users.name as user_name')
            ->get();

        $personalityTestData = DB::table('personality_test_results')
            ->join('users', 'personality_test_results.user_id', '=', 'users.id')
            ->select('personality_test_results.*', 'users.name as user_name')
            ->get();

        // Fetch categories for mapping
        $categories = DB::table('categories')->pluck('name', 'id');

        // Parse JSON data
        foreach ($eligibilityData as $result) {
            $result->grades = json_decode($result->grades, true);
        }

        foreach ($personalityTestData as $result) {
            $result->category_counts = json_decode($result->category_counts, true);
            $result->top_categories = array_map(function ($categoryId) use ($categories) {
                return $categories[$categoryId];
            }, json_decode($result->top_categories, true));
        }

        // Pass data to the view
        return view('index', compact('eligibilityData', 'personalityTestData'));
    }
}
