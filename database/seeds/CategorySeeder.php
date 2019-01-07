<?php

use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        factory(App\Category::class, 10)
            ->create()
            ->each(function($category){
                $category->products()->saveMany(factory(App\Product::class, 20)->make());
            });        
    }
}
