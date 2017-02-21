<?php

use Illuminate\Database\Seeder;

class TitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //高校艦隊 吹響吧上低音號 不起眼女主角培育法
        DB::table('titles')->insert([
            'title' => '高校艦隊',
            'title_jp' => 'ハイスクール・フリート',
            'comment' => '',
            // http://cal.syoboi.jp/tid/4095
        ]);
        DB::table('titles')->insert([
            'title' => '吹響吧上低音號',
            'title_jp' => '響け！ユーフォニアム',
            'comment' => '',
            // http://cal.syoboi.jp/tid/3687
        ]);
        DB::table('titles')->insert([
            'title' => '不起眼女主角培育法',
            'title_jp' => '冴えない彼女の育てかた',
            'comment' => '',
            // http://cal.syoboi.jp/tid/3595
        ]);
    }
}
