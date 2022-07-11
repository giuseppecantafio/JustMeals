<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use Illuminate\Support\Str;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items=[
            [
                "name" => "Pizzeria Da Clelia",
                "address" => "Via Po",
                "vat" => "24513658623",
            ],
            [
                "name" => "SushiGo",
                "address" => "Via ciao",
                "vat" => "24542658623",
            ],
            [
                "name" => "Pizzeria da Leo",
                "address" => "Via scomparso 69",
                "vat" => "24513625862",
            ],
            [
                "name" => "Ristorante Il Sogno",
                "address" => "Via Stella",
                "vat" => "24513658453",
            ],
            ];
        foreach($items as $item){
            $newRestaurant = new Restaurant();
            $newRestaurant->name = $item['name'];
            $newRestaurant->slug = Str::of($newRestaurant->name)->slug('-');
            $newRestaurant->address = $item['address'];
            $newRestaurant->vat = $item['vat'];
            $newRestaurant->save();
        }
    }
}
