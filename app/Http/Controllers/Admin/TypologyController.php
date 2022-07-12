<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Typology;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class TypologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typologies = Typology::all();
        return view('admin.typologies.index', compact ('typologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.typologies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newTypology = new Typology();

        $newTypology->name = $data['name'];

        $slug = Str::of($data['name'])->slug("-");
        $count = 1;
        while(Typology::where('slug', $slug)->first()){
            $slug = Str::of($data['name'])->slug("-")."-{$count}";
            $count++;
        }
        $newTypology->slug = $slug;

        $newTypology->save();

        return redirect()->route('admin.typologies.show', $newTypology->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Typology $typology)
    {
        return view('admin.typologies.show', compact('typology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Typology $typology)
    {
        return view('admin.typologies.edit', compact('typology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Typology $typology)
    {
        $data = $request->all();

        if ($typology->name != $data['name']){

            $typology->name = $data['name'];

            $slug = Str::of($data['name'])->slug("-");
            $count = 1;
            while(Typology::where('slug', $slug)->first()){
                $slug = Str::of($data['name'])->slug("-")."-{$count}";
                $count++;
            }
            $typology->slug = $slug;
        }

        $typology->update();

        return redirect()->route('admin.typologies.show', $typology->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Typology $typology)
    {
        $typology->delete();

        return redirect()->route('admin.typologies.index');
    }
}
