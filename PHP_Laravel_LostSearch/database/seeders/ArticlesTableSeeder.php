<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // �������ǉ�
class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
{
  // articles�e�[�u���Ƀf�[�^��insert
  DB::table('articles')->insert([
    [
      'title' => '�^�C�g��1',
      'body' => '���e1'
    ],
    [
      'title' => '�^�C�g��2',
      'body' => '���e2'
    ],
    [
      'title' => '�^�C�g��3',
      'body' => '���e3'
    ],
  ]);

}
}