<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = ['Antipasto', 'Primo', 'Secondo', 'Contorno', 'Dolce'];

        foreach($items as $item){
            $newCategory = new Category();
            $newCategory->name = $item;
            $newCategory->slug = Str::of($newCategory->name)->slug('-');
            $newCategory->save();
        }
    }
}
