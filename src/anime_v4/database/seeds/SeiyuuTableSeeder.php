<?php

use Illuminate\Database\Seeder;

class SeiyuuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('seiyuu')->insert([
            'seuyuu' => '夏川椎菜',
            'seuyuu_jp' => '夏川椎菜',
        ]);
        DB::table('seiyuu')->insert([
            'seuyuu' => 'Lynn',
            'seuyuu_jp' => 'Lynn',
        ]);
        DB::table('seiyuu')->insert([
            'seuyuu' => '雨宮天',
            'seuyuu_jp' => '雨宮天',
        ]);
    }
}
