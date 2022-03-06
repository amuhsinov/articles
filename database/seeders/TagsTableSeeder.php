<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'tag1'
        ]);
        DB::table('tags')->insert([
            'name' => 'tag2'
        ]);
        DB::table('tags')->insert([
            'name' => 'tag3'
        ]);
    }
}
