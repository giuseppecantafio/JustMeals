<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Typology;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typologies = Typology::all();
        $restaurants = Restaurant::all();
        return view('admin.restaurants.index', compact('restaurants', 'typologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typologies = Typology::all();
        return view('admin.restaurants.create', compact('typologies'));
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
        $newRestaurant = new Restaurant();
        $newRestaurant->name = $data['name'];
        $slug = Str::of($data['name'])->slug("-");
        $count = 1;
        while(Restaurant::where('slug', $slug)->first()){
            $slug = Str::of($data['name'])->slug("-")."-{$count}";
            $count++;
        }
        $newRestaurant->slug = $slug;
        $newRestaurant->address = $data['address'];
        if( isset($data['image']) ) {
            $path_image = Storage::put("uploads", $data['image']); // uploads/nomeimg.jpg
            $newRestaurant->image = $path_image;
        }
        $newRestaurant->vat = $data['vat'];
        $newRestaurant->save();

        if(isset($data['typologies'])){
            $newRestaurant->typologies()->sync($data['typologies']);
        }

        return redirect()->route('admin.restaurants.show', $newRestaurant->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $data = $request->all();
        if ($restaurant->name != $data['name']){
            $restaurant->name = $data['name'];
            $slug = Str::of($data['name'])->slug("-");
            $count = 1;
            while(Restaurant::where('slug', $slug)->first()){
                $slug = Str::of($data['name'])->slug("-")."-{$count}";
                $count++;
            }
            $restaurant->slug = $slug;
        }
        $restaurant->address = $data['address'];
        if( isset($data['image']) ) {
            $path_image = Storage::put("uploads", $data['image']); // uploads/nomeimg.jpg
            $restaurant->image = $path_image;
        }
        $restaurant->vat = $data['vat'];
        $restaurant->update();
        return redirect()->route('admin.restaurants.show', $restaurant->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index');
    }
}
