<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = \App\Models\Category::create([
            'title' => 'روايات'
        ]);
        $category = \App\Models\Category::create([
            'title' => 'تطوير ذات'
        ]);
        $category = \App\Models\Category::create([
            'title' => 'الشعر'
        ]);
        $category = \App\Models\Category::create([
            'title' => 'قصص'
        ]);
        $category = \App\Models\Category::create([
            'title' => 'كتب مترجمة'
        ]);
    }
}
