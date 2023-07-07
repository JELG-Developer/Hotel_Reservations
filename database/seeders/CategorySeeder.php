<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = new Category();
        $category->name = 'Individual';
        $category->description = ' 1 Cama '; 
        $category->save();

        $category = new Category();
        $category->name = 'Doble';
        $category->description = ' 2 camas '; 
        $category->save();

        $category = new Category();
        $category->name = 'Ejecutiva';
        $category->description = ' 1 habitacion espaciosa , escritorio '; 
        $category->save();

        $category = new Category();
        $category->name = 'Suite';
        $category->description = ' Dormitorio , sala de estar ,comedor  '; 
        $category->save();

        $category = new Category();
        $category->name = 'Familiar';
        $category->description = ' 1 Dormitorio , 2 camas individuales ,comedor  '; 
        $category->save();
    }
}
