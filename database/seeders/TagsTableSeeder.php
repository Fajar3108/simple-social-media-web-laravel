<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $tags = collect(['Laravel', 'PHP', 'HTML', 'CSS', 'JavaScript', 'Code']);
        $tags->each(function($c){
            \App\Models\Tag::create([
                'name' => $c,
                'slug' => Str::slug($c),
            ]);
        });
    }
}
