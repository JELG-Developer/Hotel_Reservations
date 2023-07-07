<?php

namespace Database\Seeders;

use App\Models\Paymenth;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymenthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pay = new Paymenth();
        $pay->type = 'Debito'; 
        $pay->save();

        $pay = new Paymenth();
        $pay->type = 'Credito'; 
        $pay->save();

    }
}
