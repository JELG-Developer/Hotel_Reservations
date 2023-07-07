<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Bokking;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener la suma de la cantidad de personas en las reservas
        $reservations = Bokking::sum('amount');

        // Multiplicar por 3 para obtener la cantidad de alimentos
        $foodAmount = $reservations * 3;

        // Crear un nuevo registro de alimento
        $food = new Food();
        $food->type = 'Gourmet';
        $food->amount = $foodAmount;
        $food->save();
    }
}
