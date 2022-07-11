<?php

use Illuminate\Database\Seeder;
use App\Item;
use Illuminate\Support\Str;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items=[
            // fk1
            [
                "name" => "Pizza Clelia",
                "price" => 15,
                "description" => "La pizza w3c",
                "available" => true,
                "fk" => 1
            ],
            [
                "name" => "Pizza Pazza",
                "price" => 7.5,
                "description" => "lorem ipsum",
                "available" => false,
                "fk" => 1
            ],
            [
                "name" => "Pizza Leonino",
                "price" => 69,
                "description" => "Una pizza che c'è ma non c'è",
                "available" => true,
                "fk" => 1
            ],
            [
                "name" => "Margherita Stellata",
                "price" => 17.99,
                "description" => "Pomodoro mozzarella",
                "available" => false,
                "fk" => 1
            ],
            // fk 2
            [
                "name" => "Hosomaki Sake",
                "price" => 12,
                "description" => "Rotolini di riso con salmone e alghe nori",
                "available" => true,
                "fk" => 2
            ],
            [
                "name" => "Uramaki Philadelphia",
                "price" => 7.5,
                "description" => "Rotolini di riso con salmone e Philadelphia",
                "available" => false,
                "fk" => 2
            ],
            [
                "name" => "Sashimi di tonno",
                "price" => 15,
                "description" => "Fettine di tonno crudo",
                "available" => true,
                "fk" => 2
            ],
            [
                "name" => "Udon di pesce",
                "price" => 11,
                "description" => "Pasta ripassata con pesce",
                "available" => false,
                "fk" => 2
            ],

            // fk3
            [
                "name" => "C'era una volta",
                "price" => 8,
                "description" => "Fantasia del pizzaiolo",
                "available" => true,
                "fk" => 3
            ],
            [
                "name" => "Schroedinger",
                "price" => 7.5,
                "description" => "Apri la scatola e vedi",
                "available" => false,
                "fk" => 3
            ],
            [
                "name" => "Pizza Leo",
                "price" => 69,
                "description" => "Una pizza che c'è ma non c'è",
                "available" => true,
                "fk" => 3
            ],
            [
                "name" => "Boh",
                "price" => 17.99,
                "description" => "Boh.....?",
                "available" => false,
                "fk" => 3
            ],

            // fk4
            [
                "name" => "Crudi di Mare",
                "price" => 40,
                "description" => "Letto di lattughina fresca con selezione di pescato del giorno",
                "available" => true,
                "fk" => 4
            ],
            [
                "name" => "Sogno di Risotto",
                "price" => 32,
                "description" => "Risotto all'anguilla con profumo di agrumi",
                "available" => false,
                "fk" => 4
            ],
            [
                "name" => "Aragosta del Mar Morto",
                "price" => 120,
                "description" => "Aragosta pregiata del Mar Morto in salsa fumè",
                "available" => true,
                "fk" => 4
            ],
            [
                "name" => "MilleSogni",
                "price" => 22.99,
                "description" => "Millefoglie ai pistacchi di Bronte",
                "available" => false,
                "fk" => 4
            ],
        ];
        foreach($items as $item){
            $newItem = new Item();
            $newItem->name = $item['name'];
            $newItem->slug = Str::of($newItem->name)->slug('-');
            $newItem->price = $item['price'];
            $newItem->description = $item['description'];
            $newItem->available = $item['available'];
            $newItem->restaurant_id = $item['fk'];
            $newItem->save();
        }
    }
}
