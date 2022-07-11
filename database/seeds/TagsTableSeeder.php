<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $items = ['Celiaco', 'Vegetariano', 'Vegano', 'Piccante', 'Consigliato dallo Chef'];

        foreach($items as $item){
            $newTag = new Tag();
            $newTag->name = $item;
            $newTag->slug = Str::of($newTag->name)->slug('-');
            $newTag->save();
        }
    }
}
