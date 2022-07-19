<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Item;
use App\Typology;
use Illuminate\Support\Facades\DB;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();

        if ($data == []){
            $restaurants = Restaurant::with('typologies')->get();
        } else {
            
            $queryParams = [];
    
            if(isset($data['typology'])){
                $queryParams = explode(',', $data['typology']);      
            } else{
                // dd('query sbagliata');
                abort(400);
            }            

            $restaurants = Restaurant::whereHas('typologies', function($q) use($queryParams) {
                    $q->whereIn('typology_id', $queryParams);
                })->with('typologies')->get();

        }

        return response()->json($restaurants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $restaurant = Restaurant::where("slug", $slug)->with(["typologies", "items"])->first();
        return response()->json($restaurant);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
