<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ←これを追加
class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
{
  // articlesテーブルにデータをinsert
  DB::table('articles')->insert([
    [
      'title' => 'タイトル1',
      'body' => '内容1'
    ],
    [
      'title' => 'タイトル2',
      'body' => '内容2'
    ],
    [
      'title' => 'タイトル3',
      'body' => '内容3'
    ],
  ]);

}
}