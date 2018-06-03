<?php

use Illuminate\Database\Seeder;

class maths_question extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maths_question')->insert([
 
'question' => 'question',
'a' => 'a',
'b' => 'b',
'c' => 'c',
'd' => 'd',
'answer' => 'answer',
'question' => 'question',
 
]);
    }
}
