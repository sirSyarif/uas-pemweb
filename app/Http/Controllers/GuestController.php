<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Category;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $journals = Journal::query();

        if ($request->title) {
            $journals->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->publication_date) {
            $journals->whereYear('publication_date', $request->input('publication_date'));
        }

        if ($request->category) {
            $journals->where('category_id', $request->input('category'));
        }

        $journals = $journals->paginate(2);

        $categories = Category::all();

        $citationTypes = [
            'APA',
            'MLA',
            'Chicago',
        ];

        return view('welcome', compact('journals', 'categories', 'citationTypes'));
    }
}
