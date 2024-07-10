<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Tag;
use App\Http\Requests\TagRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tags= Tag::all();
        return view('tags.index', ['tags'=>$tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TagRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TagRequest $request)
    {
        $tag = new Tag;
		$tag->name = $request->input('name');
        $tag->save();

        return to_route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.show',['tag'=>$tag]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit',['tag'=>$tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TagRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TagRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
		$tag->name = $request->input('name');
        $tag->save();

        return to_route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return to_route('tags.index');
    }
}
