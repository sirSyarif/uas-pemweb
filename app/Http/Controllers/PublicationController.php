<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication; // Import model Publication

class PublicationController extends Controller
{
    public function index()
    {
        return view('publications.index');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $publications = Publication::where('title', 'like', '%' . $searchTerm . '%')
            ->orWhere('authors', 'like', '%' . $searchTerm . '%')
            ->orWhere('year', 'like', '%' . $searchTerm . '%')
            ->orderBy('title')
            ->get('');

        return view('publications.index', compact('publications', 'searchTerm'));
    }
}
