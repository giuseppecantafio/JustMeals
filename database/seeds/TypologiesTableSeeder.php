<?php

use Illuminate\Database\Seeder;
use App\Typology;
use Illuminate\Support\Str;

class TypologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = ['Giapponese', 'Pizzeria', 'Italiano', 'Celiaco'];

        foreach($items as $item){
            $newTypology = new Typology();
            $newTypology->name = $item;
            $newTypology->slug = Str::of($newTypology->name)->slug('-');
            $newTypology->save();
        }
    }
}
