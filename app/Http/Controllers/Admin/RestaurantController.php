<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Typology;
use Illuminate\Support\Str;
use Faker\Core\Number;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{

    protected $validationRule = [
        "name" => "required|string|max:100",
        "address" => "required|string|max:255",
        "image" => "nullable|image|max:2048",
        "vat" => "numeric|required|digits:11",
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typologies = Typology::all();
        $auth_user = Auth::user()->id;
        $restaurants = Restaurant::where('user_id', $auth_user)->get();
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
        $request->validate($this->validationRule);
        $data = $request->all();

        // validazioni di address
        $numberChecked = Restaurant::validateNumber($data['address']);
        $viaChecked = Restaurant::validateStreet($data['address']);

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

        $newRestaurant->user_id = Auth::user()->id;

        // salvataggio in base a validazione dell'address
        if($numberChecked == true && $viaChecked == true){
            $newRestaurant->save();

            if(isset($data['typologies'])){
                $newRestaurant->typologies()->sync($data['typologies']);
            }

            return redirect()->route('admin.restaurants.show', $newRestaurant->id);
        } elseif ($numberChecked == true){
            return redirect()->back()->withInput()->with('myError', 'Si prega di inserire una Via, Corso, Strada, ecc');
        } elseif ($viaChecked == true){
            return redirect()->back()->withInput()->with('myError', 'Si prega di inserire un Numero Civico');
        } else {
            return redirect()->back()->withInput()->with('myError', 'Si prega di inserire una Via e un Numero Civico');
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {

        // controllo autenticazione
        $auth_user = Auth::user()->id;
        if ($auth_user != $restaurant->user_id){
            abort(401);
        }

        


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
        // controllo autenticazione
        $auth_user = Auth::user()->id;
        if ($auth_user != $restaurant->user_id){
            abort(401);
        }

        $typologies = Typology::all();
        return view('admin.restaurants.edit', compact('restaurant', 'typologies'));
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
        // controllo autenticazione
        $auth_user = Auth::user()->id;
        if ($auth_user != $restaurant->user_id){
            abort(401);
        }

        $request->validate($this->validationRule);
        $data = $request->all();

        // validazioni di address
        $numbers=[
            0,1,2,3,4,5,6,7,8,9
        ];
        $vie=[
            'Via', 'Piazza', 'Largo', 'Strada', 'Stradone', 'Contrada', 'Rione', 'Circonvallazione', "Ca'"
        ];
        $numberChecked = false;
        $viaChecked = false;
        foreach($numbers as $number){
            if(str_contains($data["address"], $number)){
                $numberChecked = true;
            }
        }
        foreach($vie as $via){
            if(str_contains($data["address"], $via)){
                $viaChecked = true;
            }
        }


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

        // salvataggio in base a validazione dell'address
        if($numberChecked == true && $viaChecked == true){

            $restaurant->update();

            $restaurant->typologies()->sync($data['typologies']);

            return redirect()->route('admin.restaurants.show', $restaurant->id);

        } elseif ($numberChecked == true){
            return redirect()->back()->withInput()->with('myError', 'Si prega di inserire una Via');
        } elseif ($viaChecked == true){
            return redirect()->back()->withInput()->with('myError', 'Si prega di inserire un Numero Civico');
        } else {
            return redirect()->back()->withInput()->with('myError', 'Si prega di inserire una Via e un Numero Civico');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        // controllo autenticazione
        $auth_user = Auth::user()->id;
        if ($auth_user != $restaurant->user_id){
            abort(401);
        }

        $restaurant->typologies()->sync([]);
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index');
    }
}
