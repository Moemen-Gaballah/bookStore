<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book = \App\Models\Book::create([
            'name' => 'سور الوهم العظيم',
            'author' => 'مشعل الرشيد',
            'category_id' => '1',
            'price' => 50.55,
            'stock' => 40
        ]);
        $book = \App\Models\Book::create([
            'name' =>'فن المحاولة',
            'author' => 'محمد سالم',
            'category_id' => '1',
            'price' => 99,
            'stock' => 35
        ]);
        $book = \App\Models\Book::create([
            'name' => 'فن الملاحظة',
            'author' => ' روب والكر',
            'category_id' => '1',
            'price' => 50.99,
            'stock' => 40
        ]);
        $book = \App\Models\Book::create([
            'name' =>  'على مشارف الليل',
            'author' => 'رشا عدلى',
            'category_id' => '1',
            'price' => 43,
            'stock' => 12
        ]);
    }
}
