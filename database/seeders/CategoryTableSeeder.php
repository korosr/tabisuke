<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate(); //2回目実行の際にシーダー情報をクリア
        DB::table('categories')->insert([
           'category_name' => '移動',
        ]);
        DB::table('categories')->insert([
        'category_name' => '観光',
        ]);
        DB::table('categories')->insert([
            'category_name' => '食事',
        ]);
        DB::table('categories')->insert([
            'category_name' => 'カフェ',
        ]);
        DB::table('categories')->insert([
            'category_name' => '買い物',
        ]);
        DB::table('categories')->insert([
            'category_name' => '宿',
        ]);
        DB::table('categories')->insert([
            'category_name' => 'フリータイム',
        ]);
    }
}
