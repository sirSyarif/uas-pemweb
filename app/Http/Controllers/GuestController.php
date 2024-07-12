<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

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

    public function exportToCsv(Request $request)
    {
        $journals = Journal::query();

        if ($request->title) {
            $journals->where('title', 'like', '%'. $request->input('title'). '%');
        }

        if ($request->publication_date) {
            $journals->whereYear('publication_date', $request->input('publication_date'));
        }

        if ($request->category) {
            $journals->where('category_id', $request->input('category'));
        }

        $journals = $journals->get();

        $headers = [
            'Title',
            'Publication Date',
            'Author',
            'Volume',
            'Publisher'
        ];

        $rows = [];
        foreach ($journals as $journal) {
            $rows[] = [
                $journal->title,
                $journal->publication_date,
                $journal->author,
                $journal->volume,
                $journal->publisher,
            ];
        }

        $response = new StreamedResponse();
        $response->setCallback(function () use ($headers, $rows) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $headers);
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        });
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="journals.csv"');
        $response->headers->set('Cache-Control', 'ax-age=0');

        return $response;
    }

    public function downloadPdf(Journal $journal)
    {
        $filePath = storage_path('app/public/' . $journal->path);
        $fileName = $journal->title . '.pdf';

        if (file_exists($filePath)) {
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ];

            return response()->download($filePath, $fileName, $headers);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }
}