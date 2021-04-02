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
            'title' => 'سور الوهم العظيم',
            'author' => 'مشعل الرشيد',
            'category_id' => '1',
            'description' => 'description description description',
            'price' => 50.55,
            'stock' => 40
        ]);
        $book = \App\Models\Book::create([
            'title' =>'فن المحاولة',
            'author' => 'محمد سالم',
            'category_id' => '1',
            'description' => 'description description description',
            'price' => 99,
            'stock' => 35
        ]);
        $book = \App\Models\Book::create([
            'title' => 'فن الملاحظة',
            'author' => ' روب والكر',
            'category_id' => '1',
            'description' => 'description description description',
            'price' => 50.99,
            'stock' => 40
        ]);
        $book = \App\Models\Book::create([
            'title' =>  'على مشارف الليل',
            'author' => 'رشا عدلى',
            'category_id' => '1',
            'description' => 'description description description',
            'price' => 43,
            'stock' => 12
        ]);
    }
}
