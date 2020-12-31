<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $categories = collect(['Website', 'Programming', 'Design', 'Game', 'Animation', 'Android']);
        $categories->each(function($c){
            \App\Models\Category::create([
                'name' => $c,
                'slug' => Str::slug($c),
            ]);
        });

    }
}
