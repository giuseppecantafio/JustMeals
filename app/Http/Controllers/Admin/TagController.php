<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    protected $validationRules=[
        "name" => "required|string|max:150"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);
        $data = $request->all();
        $newTag = new Tag();

        $newTag->name = $data['name'];

        $slug = Str::of($data['name'])->slug("-");
        $count = 1;
        while(Tag::where('slug', $slug)->first()){
            $slug = Str::of($data['name'])->slug("-")."-{$count}";
            $count++;
        }
        $newTag->slug = $slug;

        $newTag->save();

        return redirect()->route('admin.tags.show', $newTag->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate($this->validationRules);
         $data = $request->all();

        if ($tag->name != $data['name']){

            $tag->name = $data['name'];

            $slug = Str::of($data['name'])->slug("-");
            $count = 1;
            while(Tag::where('slug', $slug)->first()){
                $slug = Str::of($data['name'])->slug("-")."-{$count}";
                $count++;
            }
            $tag->slug = $slug;
        }

        $tag->update();

        return redirect()->route('admin.tags.show', $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index');
    }
}
