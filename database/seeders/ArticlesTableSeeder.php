<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'title' => 'title1',
            'description' => 'desc1',
            'image' => 'image1'
        ]);
        DB::table('articles')->insert([
            'title' => 'title2',
            'description' => 'desc2',
            'image' => 'image2'
        ]);
        DB::table('articles')->insert([
            'title' => 'title3',
            'description' => 'desc3',
            'image' => 'image3'
        ]);
    }
}
