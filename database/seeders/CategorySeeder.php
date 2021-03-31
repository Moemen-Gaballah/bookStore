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
            'name' => 'روايات'
        ]);
        $category = \App\Models\Category::create([
            'name' => 'تطوير ذات'
        ]);
        $category = \App\Models\Category::create([
            'name' => 'الشعر'
        ]);
        $category = \App\Models\Category::create([
            'name' => 'قصص'
        ]);
        $category = \App\Models\Category::create([
            'name' => 'كتب مترجمة'
        ]);
    }
}
