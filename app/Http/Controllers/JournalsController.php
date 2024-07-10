<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Journal;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\JournalRequest;
use Illuminate\Support\Facades\Storage;

class JournalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $journals= Journal::all();
        return view('journals.index', ['journals'=>$journals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        return view('journals.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  JournalRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(JournalRequest $request)
    {
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');

        $journal = new Journal;
		$journal->name = $request->input('name');
		$journal->category_id = $request->input('category_id');
        $journal->path = $path;
        $journal->save();

        $journal->tags()->sync($request->input('tag_ids'));

        return to_route('journals.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $journal = Journal::findOrFail($id);
        return view('journals.show',['journal'=>$journal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $journal = Journal::findOrFail($id);
        return view('journals.edit',['journal'=>$journal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  JournalRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(JournalRequest $request, $id)
    {
        $journal = Journal::findOrFail($id);
		$journal->name = $request->input('name');
        $journal->save();

        return to_route('journals.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);
        $journal->delete();

        return to_route('journals.index');
    }
}
