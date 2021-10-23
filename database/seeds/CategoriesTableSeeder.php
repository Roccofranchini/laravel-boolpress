<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'HTML', 'color' => 'danger'],
            ['name' => 'CSS', 'color' => 'warning'],
            ['name' => 'PHP', 'color' => 'primary'],
            ['name' => 'VueJS', 'color' => 'success'],
            ['name' => 'Laravel', 'color' => 'secondary'],
            ['name' => 'JS', 'color' => 'warning']
    ];

        foreach($categories as $category) {
            $newCategory = new  Category();

            $newCategory->name = $category['name'];
            $newCategory->color = $category['color'];

            $newCategory->save();
        }
    }
}
